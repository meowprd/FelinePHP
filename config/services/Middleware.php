<?php

return function (League\Container\Container $container) {
    $container->add(\meowprd\FelinePHP\Http\Middleware\RequestHandlerInterface::class, \meowprd\FelinePHP\Http\Middleware\RequestHandler::class)
        ->addArgument($container);

    $container->add(\meowprd\FelinePHP\Http\Middleware\Handlers\RouterDispatch::class)
        ->addArgument(\meowprd\FelinePHP\Routing\Router::class)
        ->addArgument($container)
        ->addArgument(\Rakit\Validation\Validator::class);
};