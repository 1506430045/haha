<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/16
 * Time: 下午8:18
 */

namespace DesignPatten\Behavioral\Observer;


interface Observable
{
    function addObserver(Observer $observer);
}