<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';

$request = meowprd\FelinePHP\Http\Request::createFromGlobals();

$response = (new \meowprd\FelinePHP\Http\Kernel())->handle(meowprd\FelinePHP\Http\Request::createFromGlobals());
$response->send();