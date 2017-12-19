<?php
//https://segmentfault.com/a/1190000003817321#articleHeader2
define('ROOT_DIR', __DIR__ . '/..');
require_once ROOT_DIR . '/vendor/autoload.php';

phpinfo();die;
use \DesignPatten\Structral\Decorator;

$zhangsan = new Decorator\Person('zhangshan');
$lisi = new Decorator\Person('lisi');

$sneaker = new Decorator\Sneaker();
$coat = new Decorator\Coat();

//$coat->display();

$trousers = new Decorator\Trousers();   //裤子
$tshirt   = new Decorator\TShirt();

$trousers->decorate($lisi);
$tshirt->decorate($trousers);
$coat->decorate($tshirt);

$coat->display();

