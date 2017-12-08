<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/17
 * Time: 下午12:01
 */

namespace DesignPatten\Structral\Decorator;

/**
 * 运动鞋
 *
 * Class Sneaker
 * @package DesignPatten\Structral\Decorator
 */
class Sneaker extends Clothes
{
    public function display()
    {
        echo "运动鞋 ";
        parent::display();
    }
}