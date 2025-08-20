<?php

return function(League\Container\Container $container) {
    $container->add(meowprd\FelinePHP\Http\Kernel::class)
        ->addArgument(\meowprd\FelinePHP\Http\Middleware\RequestHandlerInterface::class);
};