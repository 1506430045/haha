<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/8/7
 * Time: 上午10:38
 */

namespace Model\Redis;

use Config\RedisConfig;

class LogModel
{
    private $redis;

    public static $severity = [
        'DEBUG' => 'debug',
        'INFO' => 'info',
        'WARNING' => 'warning',
        'ERROR' => 'error',
        'CRITICAL' => 'critical'
    ];

    public function __construct()
    {
        $this->redis = BaseModel::getInstance(RedisConfig::$defaultConfig)->redis;
    }

    /**
     * 最新的log
     *
     * @param $name
     * @param $message
     * @param string $severity
     * @param bool $pipe
     */
    public function logRecent($name, $message, $severity = 'info', $pipe = false)
    {
        $severity = strtolower($severity);
        $destination = sprintf("recent:%s:%s", $name, $severity);
        $message = date('Y-m-d H:i:s') . ' ' . $message;
        $redis = $pipe ? $this->redis->multi() : $this->redis;
        $redis->lPush($destination, $message);
        $redis->lTrim($destination, 0, 99);
        $redis->exec();
    }

    /**
     *
     * @param $name
     * @param $message
     * @param string $severity
     * @param int $timeout
     * @return bool
     */
    public function logCommon($name, $message, $severity = 'info', $timeout = 5)
    {
        $severity = strtolower($severity);
        $destination = sprintf("recent:%s:%s", $name, $severity);
        $startKey = $destination . ':start';
        $pipe = $this->redis->multi(\Redis::PIPELINE);  //开启管道
        $end = time() + $timeout;
        while (time() < $end) {
            try {
                $pipe->watch($startKey);
                $hourStart = date('G');

                $existing = $this->redis->get($startKey);
                $pipe->multi();      //开启事务
                if ($existing && $existing < $hourStart) {
                    $pipe->rename($destination, $destination . ':last');
                    $pipe->rename($startKey, $destination . ':pstart');
                    $pipe->set($startKey, $hourStart);
                }
                $pipe->hIncrBy($destination, $message, 1);
                $this->logRecent($name, $message, $severity);
                return true;
            } catch (\RedisException $e) {
                continue;
            }
        }
        return false;
    }
}