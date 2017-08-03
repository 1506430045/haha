<?php
define('ROOT_DIR', __DIR__ . '/..');
require_once ROOT_DIR . '/vendor/autoload.php';

(new \Model\Redis\TestModel())->test('hello world');