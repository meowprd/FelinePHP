<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';

$request = meowprd\FelinePHP\Http\Request::createFromGlobals();
$response = new meowprd\FelinePHP\Http\Response('Hello, World!', 200, array());
$response->send();