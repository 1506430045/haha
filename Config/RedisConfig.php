<?php

/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/8/3
 * Time: 下午4:32
 */
namespace Config;

class RedisConfig
{
    public static $defaultConfig = [
        'host' => '127.0.0.1',
        'port' => 6379,
        'time_out' => 1,
        'auth' => '123456'
    ];
}