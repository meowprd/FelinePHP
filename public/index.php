<?php
require_once dirname(__DIR__) . '/config/app.php';
require_once ROOT_PATH . '/vendor/autoload.php';

$request = meowprd\FelinePHP\Http\Request::createFromGlobals();

$response = (
    new \meowprd\FelinePHP\Http\Kernel(
        new meowprd\FelinePHP\Routing\Router()
    ))->handle(meowprd\FelinePHP\Http\Request::createFromGlobals()
    );
$response->send();