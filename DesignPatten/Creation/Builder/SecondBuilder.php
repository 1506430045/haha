<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/10
 * Time: 下午9:30
 */

namespace DesignPatten\Creation\Builder;


class SecondBuilder extends Builder
{
    public function buildProduct()
    {
        parent::buildProduct();
        $this->product->setName("The product of second builder");
    }
}