<?php

return function (League\Container\Container $container) {
    $container->add(\meowprd\FelinePHP\Console\Kernel::class)
        ->addArgument($container);
};