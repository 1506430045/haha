<?php

/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/12/5
 * Time: 下午12:00
 */
namespace Model\Mongo;

class DemoModel
{
    protected static $dbConfig = [
        'host' => '127.0.0.1',
        'port' => '27017',
        'database' => 'test_db',
        'collection' => 'test'
    ];

    public function test()
    {
        $row = ['name' => 'tom', 'age' => 12, 'sex' => 2];
        $re = BaseModel::getInstance(self::$dbConfig)->insert($row);
        var_dump($re);
    }
}