<?php

/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/8/3
 * Time: 下午4:05
 */
namespace Model\Redis;

use Config\RedisConfig;

class TestModel
{
    private $_redis;

    public function __construct()
    {
        $this->_redis = BaseModel::getInstance(RedisConfig::$defaultConfig)->redis;
    }

    public function test($testVal = '2121')
    {
        $this->_redis->set('test_key', $testVal);
        echo $this->_redis->get('test_key');
    }
}