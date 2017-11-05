<?php

/**
 * 注册台模式并不是很常见，它也不是一个典型的创建模式，只是为了利用静态方法更方便的存取数据。
 *
 * User: xiangqian
 * Date: 17/11/5
 * Time: 下午3:52
 */
namespace DesignPatten\Creation\Registry;

class Package
{
    protected static $data = [];

    public static function set($key, $value)
    {
        self::$data[$key] = $value;
    }

    public static function get($key)
    {
        return self::$data[$key];
    }

    final public static function removeObject($key)
    {
        if (array_key_exists($key, self::$data)) {
            unset(self::$data[$key]);
        }
    }
}