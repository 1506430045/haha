<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/8
 * Time: 下午9:14
 */

namespace DesignPatten\Creation\ObjectPool;


class Factory
{
    protected static $products = [];

    public static function pushProduct(Product $product)
    {
        self::$products[$product->getId()] = $product;
    }

    public static function getProduct($id)
    {
        return isset(self::$products[$id]) ? self::$products[$id] : null;
    }

    public static function removeProduct($id)
    {
        if (array_key_exists($id, self::$products)) {
            unset(self::$products[$id]);
        }
    }
}