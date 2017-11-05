<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/5
 * Time: 下午4:24
 */

namespace DesignPatten\Creation\AbstractFactory;


class SecondFactory extends AbstractFactory
{
    public function getProduct()
    {
        return new SecondProduct();
    }
}