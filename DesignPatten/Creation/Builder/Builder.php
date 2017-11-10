<?php
/**
 * 构造者模式主要在于创建一些复杂的对象
 *
 * User: xiangqian
 * Date: 17/11/10
 * Time: 下午9:26
 */

namespace DesignPatten\Creation\Builder;


abstract class Builder
{
    protected $product;

    public function getProduct()
    {
        return $this->product;
    }

    public function buildProduct()
    {
        $this->product = new Product();
    }
}