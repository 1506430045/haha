<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/17
 * Time: 上午11:48
 */

namespace DesignPatten\Structral\Decorator;


class Clothes implements IComponent
{
    protected $component;

    /**
     * 输出
     */
    public function display()
    {
        if (!empty($this->component)) {
            $this->component->display();
        }
    }

    /**
     * 接收装饰对象
     *
     * @param IComponent $component
     */
    public function decorate(IComponent $component)
    {
        $this->component = $component;
    }
}