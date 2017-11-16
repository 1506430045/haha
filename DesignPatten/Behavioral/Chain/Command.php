<?php

/**
 * 这种模式有另一种称呼：控制链模式。
 * 它主要由一系列对于某些命令的处理器构成，每个查询会在处理器构成的责任链中传递，
 * 在每个交汇点由处理器判断是否需要对它们进行响应与处理。每次的处理程序会在有处理器处理这些请求时暂停。
 *
 * User: xiangqian
 * Date: 17/11/16
 * Time: 下午8:30
 */
namespace DesignPatten\Behavioral\Chain;

interface Command
{
    function onCommand($name, $args);
}