<?php

namespace MongoDB\Tests\Operation;

use MongoDB\Driver\BulkWrite;
use MongoDB\Operation\Aggregate;
use MongoDB\Tests\CommandObserver;
use stdClass;

class AggregateFunctionalTest extends FunctionalTestCase
{
    public function testDefaultReadConcernIsOmitted()
    {
        (new CommandObserver)->observe(
            function() {
                $operation = new Aggregate(
                    $this->getDatabaseName(),
                    $this->getCollectionName(),
                    [['$match' => ['x' => 1]]],
                    ['readConcern' => $this->createDefaultReadConcern()]
                );

                $operation->execute($this->getPrimaryServer());
            },
            function(stdClass $command) {
                $this->assertObjectNotHasAttribute('readConcern', $command);
            }
        );
    }

    public function testDefaultWriteConcernIsOmitted()
    {
        if (version_compare($this->getServerVersion(), '2.6.0', '<')) {
            $this->markTestSkipped('$out pipeline operator is not supported');
        }

        (new CommandObserver)->observe(
            function() {
                $operation = new Aggregate(
                    $this->getDatabaseName(),
                    $this->getCollectionName(),
                    [['$out' => $this->getCollectionName() . '.output']],
                    ['writeConcern' => $this->createDefaultWriteConcern()]
                );

                $operation->execute($this->getPrimaryServer());
            },
            function(stdClass $command) {
                $this->assertObjectNotHasAttribute('writeConcern', $command);
            }
        );
    }

    public function testEmptyPipelineReturnsAllDocuments()
    {
        $this->createFixtures(3);

        $operation = new Aggregate($this->getDatabaseName(), $this->getCollectionName(), []);
        $results = iterator_to_array($operation->execute($this->getPrimaryServer()));

        $expectedDocuments = [
            (object) ['_id' => 1, 'x' => (object) ['foo' => 'bar']],
            (object) ['_id' => 2, 'x' => (object) ['foo' => 'bar']],
            (object) ['_id' => 3, 'x' => (object) ['foo' => 'bar']],
        ];

        $this->assertEquals($expectedDocuments, $results);
    }

    /**
     * @expectedException MongoDB\Driver\Exception\RuntimeException
     */
    public function testUnrecognizedPipelineState()
    {
        $operation = new Aggregate($this->getDatabaseName(), $this->getCollectionName(), [['$foo' => 1]]);
        $operation->execute($this->getPrimaryServer());
    }

    /**
     * @dataProvider provideTypeMapOptionsAndExpectedDocuments
     */
    public function testTypeMapOption(array $typeMap = null, array $expectedDocuments)
    {
        $this->createFixtures(3);

        $pipeline = [['$match' => ['_id' => ['$ne' => 2]]]];
        $operation = new Aggregate($this->getDatabaseName(), $this->getCollectionName(), $pipeline, ['typeMap' => $typeMap]);
        $results = iterator_to_array($operation->execute($this->getPrimaryServer()));

        $this->assertEquals($expectedDocuments, $results);
    }

    public function provideTypeMapOptionsAndExpectedDocuments()
    {
        return [
            [
                null,
                [
                    (object) ['_id' => 1, 'x' => (object) ['foo' => 'bar']],
                    (object) ['_id' => 3, 'x' => (object) ['foo' => 'bar']],
                ],
            ],
            [
                ['root' => 'array', 'document' => 'array'],
                [
                    ['_id' => 1, 'x' => ['foo' => 'bar']],
                    ['_id' => 3, 'x' => ['foo' => 'bar']],
                ],
            ],
            [
                ['root' => 'object', 'document' => 'array'],
                [
                    (object) ['_id' => 1, 'x' => ['foo' => 'bar']],
                    (object) ['_id' => 3, 'x' => ['foo' => 'bar']],
                ],
            ],
            [
                ['root' => 'array', 'document' => 'stdClass'],
                [
                    ['_id' => 1, 'x' => (object) ['foo' => 'bar']],
                    ['_id' => 3, 'x' => (object) ['foo' => 'bar']],
                ],
            ],
        ];
    }

    /**
     * Create data fixtures.
     *
     * @param integer $n
     */
    private function createFixtures($n)
    {
        $bulkWrite = new BulkWrite(['ordered' => true]);

        for ($i = 1; $i <= $n; $i++) {
            $bulkWrite->insert([
                '_id' => $i,
                'x' => (object) ['foo' => 'bar'],
            ]);
        }

        $result = $this->manager->executeBulkWrite($this->getNamespace(), $bulkWrite);

        $this->assertEquals($n, $result->getInsertedCount());
    }
}
