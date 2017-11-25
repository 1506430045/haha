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
        $arr = [
            2, 1, 6, 11, 7, 76
        ];


        $config = Config\RedisConfig::$defaultConfig;
        (new Algorihtm\Sort\Demo())->test();
        var_dump($config);
    }
}

$o = new Test();
$o->run();