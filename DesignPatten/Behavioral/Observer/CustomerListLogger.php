<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/16
 * Time: 下午8:23
 */

namespace DesignPatten\Behavioral\Observer;


class CustomerListLogger implements Observer
{
    public function onChanged($sender, $args)
    {
        echo("'{$args}' Customer has been added to the list \n");
    }
}