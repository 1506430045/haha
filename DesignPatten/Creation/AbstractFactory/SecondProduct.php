<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/5
 * Time: 下午4:23
 */

namespace DesignPatten\Creation\AbstractFactory;


class SecondProduct implements Product
{
    public function getName()
    {
        return "The product from the second factory";
    }
}