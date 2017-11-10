<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/8
 * Time: 下午9:26
 */

namespace DesignPatten\Creation\LazyInit;


class FirstProduct implements Product
{
    public function getName()
    {
        return "The First Product";
    }
}