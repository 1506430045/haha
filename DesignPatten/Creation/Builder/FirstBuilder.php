<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/10
 * Time: 下午9:29
 */

namespace DesignPatten\Creation\Builder;


class FirstBuilder extends Builder
{
    public function buildProduct()
    {
        parent::buildProduct();
        $this->product->setName("The product of the first builder");
    }
}