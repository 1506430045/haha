<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/10
 * Time: 下午9:32
 */

namespace DesignPatten\Creation\Builder;


class Factory
{
    private $builder;

    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
        $this->builder->buildProduct();
    }

    public function getProduct()
    {
        return $this->builder->getProduct();
    }
}