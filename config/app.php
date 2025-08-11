<?php
define('ROOT_PATH', dirname(__DIR__));

$dotenv = new \Symfony\Component\Dotenv\Dotenv();
$dotenv->load(ROOT_PATH . '/.env');

const API_PREFIX = '/api';
const VIEWS_PATH = ROOT_PATH . '/views';