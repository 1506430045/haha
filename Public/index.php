<?php
//https://segmentfault.com/a/1190000003817321#articleHeader2
define('ROOT_DIR', __DIR__ . '/..');
require_once ROOT_DIR . '/vendor/autoload.php';

$firstDirector = new DesignPatten\Creation\Builder\Factory(new \DesignPatten\Creation\Builder\FirstBuilder());

echo $firstDirector->getProduct()->getName();

$secondDirector = new DesignPatten\Creation\Builder\Factory(new \DesignPatten\Creation\Builder\SecondBuilder());

echo $secondDirector->getProduct()->getName();