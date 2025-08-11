<?php
define('ROOT_PATH', dirname(__DIR__));

$dotenv = new \Symfony\Component\Dotenv\Dotenv();
$dotenv->load(ROOT_PATH . '/.env');


define('API_PREFIX', '/api');