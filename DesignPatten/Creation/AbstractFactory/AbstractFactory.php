<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/5
 * Time: 下午4:15
 */

namespace DesignPatten\Creation\AbstractFactory;


abstract class AbstractFactory
{
    public static function getFactory()
    {
        switch (Config::$factory) {
            case Config::FACTORY_ONE:
        }
    }
}