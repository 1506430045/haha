<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/17
 * Time: 下午12:04
 */

namespace DesignPatten\Structral\Decorator;

/**
 * 外套
 *
 * Class Coat
 * @package DesignPatten\Structral\Decorator
 */
class Coat extends Clothes
{
    public function display()
    {
        echo "外套 ";
        parent::display();
    }
}