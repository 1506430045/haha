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
        (new \Model\Mongo\DemoModel)->test();
    }
}

$o = new Test();
$o->run();