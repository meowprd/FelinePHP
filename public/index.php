<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';

$request = meowprd\FelinePHP\Http\Request::createFromGlobals();
dd($request);