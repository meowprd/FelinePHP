<?php

$container = new League\Container\Container();
$servicesFiles = glob(ROOT_PATH . '/config/services/*.php');
foreach ($servicesFiles as $serviceFile) {
    $registerService = require $serviceFile;
    if(is_callable($registerService)) {
        $registerService($container);
    }
}

return $container;