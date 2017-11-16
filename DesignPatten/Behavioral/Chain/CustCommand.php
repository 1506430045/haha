<?php

/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/16
 * Time: 下午8:34
 */
namespace DesignPatten\Behavioral\Chain;

class CustCommand implements Command
{
    public function onCommand($name, $args)
    {
        if ($name != 'addCustomer') {
            return false;
        }
        echo("This is CustomerCommand handling 'addCustomer'\n");
        return true;
    }
}