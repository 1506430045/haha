<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/5
 * Time: 下午4:07
 */

namespace DesignPatten\Creation\Factory;


class SecondFactory implements Factory
{
    public function getProduct()
    {
        return new SecondProduct();
    }
}