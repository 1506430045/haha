<?php
//https://segmentfault.com/a/1190000003817321#articleHeader2
define('ROOT_DIR', __DIR__ . '/..');
require_once ROOT_DIR . '/vendor/autoload.php';

use \DesignPatten\Behavioral\Chain;

$cc = new Chain\CommandChain();
$cc->addCommand(new Chain\CustCommand());
$cc->addCommand(new Chain\MailCommand());
$cc->runCommand('addCustomer', null);
$cc->runCommand('mail', null);