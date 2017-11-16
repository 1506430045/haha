<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/16
 * Time: 下午8:20
 */

namespace DesignPatten\Behavioral\Observer;


class CustomerList implements Observable
{
    private $_observers = [];

    function addObserver(Observer $observer)
    {
        $this->_observers[] = $observer;
    }

    function addCustomer($name)
    {
        foreach ($this->_observers as $observer) {
            $observer->onChanged($this, $name);
        }
    }
}