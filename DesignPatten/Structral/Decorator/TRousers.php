<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/17
 * Time: 下午12:05
 */

namespace DesignPatten\Structral\Decorator;

/**
 * 裤子
 *
 * Class Trousers
 * @package DesignPatten\Structral\Decorator
 */
class Trousers extends Clothes
{
    public function display()
    {
        echo "裤子 ";
        parent::display();
    }
}