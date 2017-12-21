<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 2017/12/10
 * Time: 下午3:38
 */

namespace Model\Es;

class EmployeeModel
{
    private $client;

    public function __construct($indexName, $indexType)
    {
        $hosts = [
            '127.0.0.1:9200'
        ];
        $client = \Elasticsearch\ClientBuilder::create()->setHosts($hosts)->build();
        $this->client = new BaseModel($client, $indexName, $indexType);
    }

    /**
     * 索引雇员
     *
     * @param array $params
     * @return array
     */
    public function indexEmployee(array $params)
    {
        return $this->client->index($params);
    }

    /**
     * 搜索雇员
     *
     * @param array $params
     * @return array
     */
    public function searchEmployee(array $params): array
    {
        return $this->client->search($params);
    }

    /**
     * 删除雇员
     *
     * @return array
     */
    public function deleteEmployeeIndex(): array
    {
        return $this->client->deleteIndex();
    }
}