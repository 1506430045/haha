<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/12/20
 * Time: 下午7:24
 */

namespace Model\Redis;


use Config\RedisConfig;

class RedisMultiTestModel
{
    private $redis;

    public function __construct()
    {
        $this->redis = BaseModel::getInstance(RedisConfig::$defaultConfig)->redis;
    }

    public function test1()
    {
        $key = 'test_key_1';
        $num = intval($this->redis->get($key));
        $num = $num + 1;
        $this->redis->setex($key, 10080, $num);
        usleep(10000);
    }

    public function test2()
    {
        $key = 'test_key_2';
        $lockKey = 'lock:' . $key;
        $token = uniqid();
        $lock = Lock::lock($lockKey, $token);
        if (!$lock) {
            return false;
        }
        $num = $this->redis->get($key);
        if (empty($num)) {
            $num = 0;
        }
        $num++;
        $this->redis->set($key, $num);

        $countKey = 'count:test_key_2';
        $this->redis->incr($countKey);
        Lock::unlock($lockKey, $token);
    }

    public function test3()
    {
        $key = "goods:1:stock";
        $script = '
            local remainNum = redis.call("decrby", KEYS[1], ARGV[1])
            if remainNum < 0 
            then
                redis.call("incrby", KEYS[1], ARGV[1])
                return 0
            else
                return 1
            end';
        $buyNumber = mt_rand(1, 5);
        $re = $this->redis->eval($script, [$key, $buyNumber], 1);
        error_log(sprintf("购买数:%s, 购买结果:%s\n", $buyNumber, $re ? '成功' : '失败'), 3, '/tmp/buy_result.log');
    }

    public function test()
    {
        $members = [1, 2, 3];
        $res = $this->redis->zRem('wq21212', ...$members);
        var_dump($res);
    }
}