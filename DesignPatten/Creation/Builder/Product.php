<?php

/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/10
 * Time: 下午9:25
 */
namespace DesignPatten\Creation\Builder;

class Product
{
    private $name;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}