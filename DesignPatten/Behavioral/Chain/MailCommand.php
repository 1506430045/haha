<?php

/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/16
 * Time: 下午8:35
 */
namespace DesignPatten\Behavioral\Chain;

class MailCommand implements Command
{
    public function onCommand($name, $args)
    {
        if ($name != 'mail')
            return false;
        echo("This is MailCommand handling 'mail'\n");
        return true;
    }
}