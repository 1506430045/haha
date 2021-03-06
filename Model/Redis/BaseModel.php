<?php

/**
 * Redis单例
 *
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
        try {
            $this->redis = new Redis();
            $this->redis->connect($config['host'], $config['port'], $config['time_out']);
            $this->redis->auth($config['auth']);
        } catch (\RedisException $e) {
            exit($e->getMessage());
        }
    }

    /**
     * 获取实例
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
        self::$_instances[$key] = new self($config);
        return self::$_instances[$key];
    }

    /**
     * 禁止克隆
     */
    public function __clone()
    {
        trigger_error('can not clone', E_USER_ERROR);
    }
}