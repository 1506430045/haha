<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/17
 * Time: 上午11:44
 */

namespace DesignPatten\Structral\Decorator;

/**
 * 待装饰对象
 *
 * Class Person
 * @package DesignPatten\Structral\Decorator
 */
class Person implements IComponent
{
    private $_name; //对象人物名称

    /**
     * Person constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->_name = $name;
    }

    public function display()
    {
        echo "装扮者：{$this->_name}<br/>";
    }
}