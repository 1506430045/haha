<?php

/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/9/20
 * Time: 上午11:08
 */
class ElasticSearch
{
    private $server;
    public $index;

    public function __construct($server = 'http://localhost:9200')
    {
        $this->server = $server;
    }

    public function call($path, $http = [])
    {
        if (!$this->index) {
            throw new Exception('$this->index needs a value');
        }
        return json_decode(file_get_contents($this->server . '/' . $this->index . '/' . $path, NULL, stream_context_create(array('http' => $http))));
    }

    //curl -X PUT http://localhost:9200/{INDEX}/
    function create()
    {
        $this->call(NULL, array('method' => 'PUT'));
    }
}