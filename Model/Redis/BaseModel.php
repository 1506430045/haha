<?php

/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/8/3
 * Time: 下午3:40
 */
namespace Model\Redis;

use \Redis;

class BaseModel
{
    private static $_instances = [];
    public $redis;

    /**
     * 构造方法
     *
     * BaseModel constructor.
     * @param array $config
     */
    private function __construct(array $config)
    {
        $this->redis = new Redis();
        $this->redis->connect($config['host'], $config['port'], $config['time_out']);
        $this->redis->auth($config['auth']);
    }

    /**
     * 获取实例
     *
     * @param array $config
     * @return BaseModel|mixed
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

    /**
     * 禁止克隆
     */
    public function __clone()
    {
        trigger_error('can not clone', E_USER_ERROR);
    }
}