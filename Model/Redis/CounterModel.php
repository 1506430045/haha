<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/8/9
 * Time: 下午2:20
 */

namespace Model\Redis;

use Config\RedisConfig;

class CounterModel
{
    const PRECISION = [
        1,      //1秒
        5,      //5秒
        60,     //1分钟
        300,    //5分钟
        3600,   //1小时
        18000,  //5小时
        86400   //1天
    ];

    public function __construct()
    {
        $this->redis = BaseModel::getInstance(RedisConfig::$defaultConfig)->redis;
    }

    /**
     * 更新计数器
     *
     * @param $name
     * @param int $count
     */
    public function updateCounter($name, $count = 1)
    {
        $now = time();
        $pipe = $this->redis->multi(\Redis::PIPELINE);
        foreach (self::PRECISION as $precision) {
            $pNow = intval($now / $precision) * $precision; //取得当前时间片的开始时间
            $hash = sprintf("%s:%s", $precision, $name);
            $pipe->zAdd('known:', 0, $hash);
            $pipe->hIncrBy('count:' . $hash, $pNow, $count);
        }
        $pipe->exec();
    }

    /**
     * 获取计数
     *
     * @param $name
     * @param $precision
     * @return array
     */
    public function getCounter($name, $precision)
    {
        $hash = sprintf("%s:%s", $precision, $name);
        $data = $this->redis->hGetAll('count:' . $hash);
        if (empty($data)) {
            return [];
        }
        asort($data);
        return $data;
    }

    public function clearCounters()
    {
        $pipe = $this->redis;
        $passes = 0;
        while (true) {
            $start = time();
            $index = 0;
            while ($index < $pipe->zCard('known:')) {
                $hash = $pipe->zRange('known:', $index, $index);
                $index += 1;
                if (empty($hash)) {
                    break;
                }
                $hash = $hash['0'];
                $precision = intval(explode(':', $hash)['0']);
                $bPrecision = intval($precision / 60);
                $bPrecision = $bPrecision ? $bPrecision : 1;
                if ($passes % $bPrecision) {
                    continue;
                }
                $hKey = 'count:' . $hash;
            }
        }
    }
}