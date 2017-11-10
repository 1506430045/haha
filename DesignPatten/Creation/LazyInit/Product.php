<?php

/**
 * 对于某个变量的延迟初始化也是常常被用到的，对于一个类而言往往并不知道它的哪个功能会被用到，而部分功能往往是仅仅被需要使用一次。
 *
 * User: xiangqian
 * Date: 17/11/8
 * Time: 下午9:25
 */
namespace DesignPatten\Creation\LazyInit;

interface Product
{
    public function getName();
}