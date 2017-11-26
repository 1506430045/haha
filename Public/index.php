<?php
//https://segmentfault.com/a/1190000003817321#articleHeader2
declare(strict_types=1);    //开启严格模式

define('ROOT_DIR', __DIR__ . '/..');
require_once ROOT_DIR . '/vendor/autoload.php';

$arr = [
    2, 1, 6, 11, 7, 76
];


$arr = (new Algorithm\Sort\Sort(new Algorithm\Sort\BubbleSort(), $arr))->sort();
var_dump($arr);
