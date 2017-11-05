<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/5
 * Time: 下午4:18
 */

namespace DesignPatten\Creation\AbstractFactory;


class FirstProduct implements Product
{
    public function getName()
    {
        return "The product from the first factory";
    }
}