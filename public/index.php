<?php

require_once dirname(__DIR__) . '/config/app.php';
require_once ROOT_PATH . '/vendor/autoload.php';

\meowprd\FelinePHP\Debug\WhoopsDebugger::register(DEBUG);
$request = \meowprd\FelinePHP\Http\Request::createFromGlobals();

/** @var \League\Container\Container $container */
$container = require ROOT_PATH . '/config/services.php';
$kernel = $container->get(meowprd\FelinePHP\Http\Kernel::class);
$response = $kernel->handle($request);
$response->send();