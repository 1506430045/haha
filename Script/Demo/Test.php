<?php

/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/7/31
 * Time: 下午3:12
 */

define('SCRIPT_BASE_DIR', __DIR__ . '/../..');

require_once SCRIPT_BASE_DIR . '/vendor/autoload.php';

class Test extends \Script\ScriptBase
{
    public function __construct()
    {
        parent::__construct();
    }

    public function run()
    {
        $arr = range(1, 1000);
        shuffle($arr);

        $arr = (new Algorithm\Sort\Sort(new Algorithm\Sort\InsertSort(), $arr))->sort();
        var_dump($arr);

    }
}

$o = new Test();
$o->run();