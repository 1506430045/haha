<?php

/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/12/5
 * Time: 上午11:00
 */
namespace Model\Mongo;

class BaseModel
{
    protected $namespace;
    protected $manager;
    protected $collection;

    private static $_instances;

    private function __construct(array $config)
    {
        $this->namespace = "{$config['database']}.{$config['collection']}";
        $this->manager = new \MongoDB\Driver\Manager("mongodb://{$config['host']}:{$config['port']}");
        $this->collection = new \MongoDB\Collection($this->manager, $config['database'], $config['collection']);
    }

    public function find()
    {
        $this->collection->find();
    }

    /**
     * 获取单例
     *
     * @param array $config
     * @return BaseModel
     */
    public static function getInstance(array $config)
    {
        ksort($config);
        $key = md5(serialize($config));
        if (isset(self::$_instances[$key]) && self::$_instances[$key] instanceof self) {
            return self::$_instances[$key];
        }
        return new self($config);
    }

    public function __clone()
    {
        trigger_error('can not clone', E_USER_ERROR);
    }

    /**
     * 插入数据
     *
     * @param array $data
     * @return \MongoDB\BSON\ObjectId
     */
    public function insert(array $data)
    {
        $bulk = new \MongoDB\Driver\BulkWrite;
        $_id = $bulk->insert($data);
        $this->manager->executeBulkWrite("{$this->namespace}", $bulk);
        return $_id;
    }

    /**
     * 更新数据
     *
     * @param array $filter
     * @param array $data
     * @param array $options
     * @return \MongoDB\Driver\WriteResult
     */
    public function update(array $filter, array $data, array $options)
    {
        $bulk = new \MongoDB\Driver\BulkWrite;
        $bulk->update($filter, $data, $options);
        return $this->manager->executeBulkWrite($this->namespace, $bulk);
    }

    /**
     * 删除数据
     *
     * @param array $filter
     * @param array $options
     * @return \MongoDB\Driver\WriteResult
     */
    public function delete(array $filter, array $options)
    {
        $bulk = new \MongoDB\Driver\BulkWrite;
        $bulk->delete($filter, $options);
        return $this->manager->executeBulkWrite($this->namespace, $bulk);
    }

    public function findOne()
    {

    }
}