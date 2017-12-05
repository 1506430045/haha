<?php

/**
 * 装饰器模式（Decorator Pattern）允许向一个现有的对象添加新的功能，同时又不改变其结构。
 * 这种类型的设计模式属于结构型模式，它是作为现有的类的一个包装
 *
 * User: xiangqian
 * Date: 17/11/17
 * Time: 上午11:43
 */
namespace DesignPatten\Structral\Decorator;

/**
 * 组件对象接口
 *
 * Interface IComponent
 * @package DesignPatten\Structral\Decorator
 */
interface IComponent
{
    public function display();
}