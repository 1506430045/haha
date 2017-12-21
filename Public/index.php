<?php
//https://segmentfault.com/a/1190000003817321#articleHeader2
define('ROOT_DIR', __DIR__ . '/..');
require_once ROOT_DIR . '/vendor/autoload.php';

(new \Model\Redis\RedisMultiTestModel)->test();

