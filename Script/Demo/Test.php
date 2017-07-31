<?php

/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/7/31
 * Time: 下午3:12
 */
namespace Script\Demo;

class Test extends \Script\ScriptBase
{
    public function __construct()
    {
    }

    public function run()
    {
        echo 'hello world';
    }
}

$o = new Test();
$o->run();