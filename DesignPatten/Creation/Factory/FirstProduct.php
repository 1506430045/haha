<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/5
 * Time: 下午4:08
 */

namespace DesignPatten\Creation\Factory;


class FirstProduct implements Product
{
    public function getName()
    {
        return "The First Product";
    }
}