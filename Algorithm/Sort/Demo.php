<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 2017/11/25
 * Time: 下午11:11
 */

namespace Algorithm\Sort;


class Demo
{
    public function test()
    {
        $arr = range(1, 1000);
        shuffle($arr);

        $sortObj = new InsertSort();
        $arr = (new Sort($sortObj, $arr))->sort();
        var_dump($arr);
    }
}