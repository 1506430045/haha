<?php
/**
 * Es基类
 *
 * User: xiangqian
 * Date: 2017/12/10
 * Time: 下午3:09
 */

namespace Model\Es;

class BaseModel
{
    private $client;        //Es客户端
    private $indexName;     //索引名称
    private $indexType;     //类型名称

    public function __construct(\Elasticsearch\Client $client, $indexName, $indexType)
    {
        $this->indexName = $indexName;
        $this->indexType = $indexType;
        $this->client = $client;
    }

    /**
     * 索引文档
     *
     * @param array $params
     * @return array
     */
    public function index(array $params): array
    {
        $params = [
            'index' => $this->indexName,
            'type' => $this->indexType,
            'body' => $params
        ];
        return $this->client->index($params);
    }

    /**
     * 搜索文档
     *
     * @param array $params
     * @return array
     */
    public function search(array $params): array
    {
        $params = [
            'index' => $this->indexName,
            'type' => $this->indexType,
            'body' => [
                'query' => [
                    'match' => $params
                ]
            ]
        ];
        return $this->client->search($params);
    }

    /**
     * 删除文档
     *
     * @return array
     */
    public function deleteIndex(): array
    {
        $params = [
            'index' => $this->indexName
        ];
        return $this->client->delete($params);
    }
}