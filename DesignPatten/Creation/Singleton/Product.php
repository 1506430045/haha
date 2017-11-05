<?php

/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/10/30
 * Time: 下午8:12
 */
namespace DesignPatten\Creation;

class Product
{
    protected static $_instance;

    private function __construct()
    {
    }

    private function __clone()
    {
        trigger_error("can't clone");
    }

    /**
     * 获取实例
     *
     * @return Product
     */
    public static function getInstance()
    {
        if (!empty(self::$_instance) && self::$_instance instanceof self) {
            return self::$_instance;
        }
        self::$_instance = new self();
        return self::$_instance;
    }

    public function test()
    {
        echo "hello world" . PHP_EOL;
    }
}