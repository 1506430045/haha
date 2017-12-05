<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/16
 * Time: 下午9:19
 */

namespace DesignPatten\Behavioral\Strategy;


class Duck
{
    private $_flyBehavior;

    public function setFlyBehavior(FlyBehavior $behavior)
    {
        $this->_flyBehavior = $behavior;
    }

    public function performFly()
    {
        $this->_flyBehavior->fly();
    }
}