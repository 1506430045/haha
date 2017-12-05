<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/17
 * Time: 下午12:02
 */

namespace DesignPatten\Structral\Decorator;

/**
 * T恤
 *
 * Class TShirt
 * @package DesignPatten\Structral\Decorator
 */
class TShirt extends Clothes
{
    public function display()
    {
        echo "T恤 ";
        parent::display();
    }
}