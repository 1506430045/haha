<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/8
 * Time: 下午9:27
 */

namespace DesignPatten\Creation\LazyInit;


class SecondProduct implements Product
{
    public function getName()
    {
        return "The Second Product";
    }
}