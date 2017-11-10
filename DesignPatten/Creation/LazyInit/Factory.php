<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/8
 * Time: 下午9:28
 */

namespace DesignPatten\Creation\LazyInit;


class Factory
{
    public $firstProduct;
    public $secondProduct;

    public function getFirstProduct()
    {
        if (!$this->firstProduct) {
            $this->firstProduct = new FirstProduct();
        }
        return $this->firstProduct;
    }

    public function getSecondProduct()
    {
        if (!$this->secondProduct) {
            $this->secondProduct = new SecondProduct();
        }
        return $this->secondProduct;
    }
}