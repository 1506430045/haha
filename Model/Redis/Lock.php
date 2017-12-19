<?php
/**
 * Redis + Lua实现锁
 *
 * User: xiangqian
 * Date: 17/12/19
 * Time: 下午5:14
 */

namespace Model\Redis;


class Lock
{
    private static $redisConfig = [
        'host' => '127.0.0.1',
        'port' => 6379,
        'time_out' => 1,
        'auth' => '123456'
    ];

    /**
     * 加锁
     *
     * @param $key
     * @param $token
     * @param int $ttl
     * @return int
     */
    public static function lock($key, $token, $ttl = 100)
    {
        $script = '
            local ok = redis.call("setnx", KEYS[1], ARGV[1])
            if ok == 1 then
                redis.call("expire", KEYS[1], ARGV[2])
            end
            return ok';
        return BaseModel::getInstance(self::$redisConfig)->redis->eval($script, [$key, $token, $ttl], 1);
    }

    /**
     * 释放锁
     *
     * @param $key
     * @param $token
     * @return int
     */
    public static function unlock($key, $token)
    {
        $script = '
            if redis.call("get",KEYS[1]) == ARGV[1]
            then    
                return redis.call("del",KEYS[1])
            else    
                return 0
            end';
        return BaseModel::getInstance(self::$redisConfig)->redis->eval($script, [$key, $token], 1);
    }
}

$key = 'test_key';              //根据业务定名称
$token = uniqid($key);          //每个请求生成唯一的token, 防止被别的请求释放锁
Lock::lock($key, $token, 60);   //加锁
#do something with lock
Lock::unlock($key, $token);     //释放锁