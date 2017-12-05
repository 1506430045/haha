<?php

/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/16
 * Time: 下午9:17
 */
namespace DesignPatten\Behavioral\Strategy;

class FlyWithNo implements FlyBehavior
{
    public function fly()
    {
        echo "Fly With No. \n";
    }
}