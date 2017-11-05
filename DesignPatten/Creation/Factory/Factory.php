<?php

/**
 * 工厂模式是另一种非常常用的模式，正如其名字所示：确实是对象实例的生产工厂。
 * 某些意义上，工厂模式提供了通用的方法有助于我们去获取对象，而不需要关心其具体的内在的实现。
 * User: xiangqian
 * Date: 17/11/5
 * Time: 下午4:04
 */
namespace DesignPatten\Creation\Factory;

interface Factory
{
    public function getProduct();
}