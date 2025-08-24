<?php

return function (League\Container\Container $container) {
    $container->addShared(\Rakit\Validation\Validation::class)
        ->addArgument(new \League\Container\Argument\Literal\ArrayArgument(array(
           // custom messages
        )));
};