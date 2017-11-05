<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/5
 * Time: 下午4:17
 */

namespace DesignPatten\Creation\AbstractFactory;


class FirstFactory extends AbstractFactory
{
    public function getProduct()
    {
        return new FirstProduct();
    }
}