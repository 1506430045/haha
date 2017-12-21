<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 2017/11/25
 * Time: 下午11:10
 */

namespace Algorithm\Sort;


interface BaseSort
{
    public function run($arr, $count): array;
}