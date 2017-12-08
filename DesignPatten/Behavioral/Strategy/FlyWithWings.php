<?php

/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/16
 * Time: 下午9:16
 */
namespace DesignPatten\Behavioral\Strategy;

class FlyWithWings implements FlyBehavior
{
    public function fly()
    {
        echo "Fly With Wings. \n";
    }
}