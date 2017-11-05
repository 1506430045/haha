<?php
define('ROOT_DIR', __DIR__ . '/..');
require_once ROOT_DIR . '/vendor/autoload.php';

$factory = new \DesignPatten\Creation\Factory\FirstFactory();
$firstProductName = $factory->getProduct()->getName();
$factory = new \DesignPatten\Creation\Factory\SecondFactory();
$secondProductName = $factory->getProduct()->getName();

var_dump($firstProductName, $secondProductName);
