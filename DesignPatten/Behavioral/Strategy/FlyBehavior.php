<?php

/**
 * 定义了算法族,分别封装起来，让它们之间可以互相替换，此模式让算法的变化独立于使用算法的客户
 *
 * User: xiangqian
 * Date: 17/11/16
 * Time: 下午9:15
 */
namespace DesignPatten\Behavioral\Strategy;

interface FlyBehavior
{
    public function fly();
}