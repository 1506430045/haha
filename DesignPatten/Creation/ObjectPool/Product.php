<?php

/**
 * 对象池可以用于构造并且存放一系列的对象并在需要时获取调用：
 *
 * User: xiangqian
 * Date: 17/11/8
 * Time: 下午9:12
 */
namespace DesignPatten\Creation\ObjectPool;

class Product
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
}