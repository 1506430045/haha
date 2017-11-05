<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/5
 * Time: 下午4:06
 */

namespace DesignPatten\Creation\Factory;


class FirstFactory implements Factory
{
    public function getProduct()
    {
        return new FirstProduct();
    }
}