<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/8/12
 * Time: 上午9:45
 */

namespace Model\Redis;


use Config\RedisConfig;

class LockModel
{
    private $redis;

    public function __construct()
    {
        $this->redis = BaseModel::getInstance(RedisConfig::$defaultConfig)->redis;
    }

    /**
     * 申请锁
     *
     * @param $lockName
     * @param int $timeout
     * @return string
     */
    public function acquireLock($lockName, $timeout = 2)
    {
        $identify = uniqid();

        $end = time() + $timeout;
        $lockName = 'lock:' . $lockName;
        while (time() < $end) {
            if ($this->redis->setnx($lockName, $identify)) {
                return $identify;
            }
            usleep(1000);
        }
        return '';
    }

    /**
     * 申请锁 带锁生存时间
     *
     * @param $lockName
     * @param int $timeout
     * @param int $lockTimeout
     * @return string
     */
    public function acquireLockWithTimeout($lockName, $timeout = 2, $lockTimeout = 5)
    {
        $identify = uniqid();
        $lockName = 'lock:' . $lockName;
        $lockTimeout = intval($lockTimeout);

        $end = time() + $timeout;
        while (time() < $end) {
            if ($this->redis->setnx($lockName, $identify)) {
                $this->redis->expire($lockName, $lockTimeout);
                return $identify;
            }
            if ($this->redis->ttl($lockName) < 0) {
                $this->redis->expire($lockName, $lockTimeout);
            }
            usleep(1000);
        }
        return '';
    }

    /**
     * 释放锁
     *
     * @param $lockName
     * @param $identify
     * @return bool
     */
    public function releaseLock($lockName, $identify)
    {
        if (empty($identify)) {
            return false;
        }
        $pipe = $this->redis->multi(\Redis::PIPELINE);
        $lockName = 'lock:' . $lockName;
        while (true) {
            try {
                $pipe->watch($lockName);
                if ($pipe->get($lockName) == $identify) {
                    $pipe->multi();
                    $pipe->delete($lockName);
                    $pipe->exec();
                    return true;
                }
            } catch (\RedisException $e) {
                continue;
            }
        }
        return false;
    }
}