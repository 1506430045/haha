<?php

/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/16
 * Time: 下午8:17
 */
namespace DesignPatten\Behavioral\Observer;

interface Observer
{
    function onChanged($sender, $args);
}