<?php

/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/8
 * Time: 下午9:36
 */
namespace DesignPatten\Creation\Prototype;

class Factory
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getProduct()
    {
        return clone $this->product;
    }
}