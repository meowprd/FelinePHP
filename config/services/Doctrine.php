<?php

return function (League\Container\Container $container) {
    $container->add(meowprd\FelinePHP\Database\ConnectionFactory::class)
        ->addArgument(new \League\Container\Argument\Literal\ArrayArgument(array(
            'driver' => $_ENV['DB_DRIVER'],
            'host' => $_ENV['DB_HOST'],
            'port' => $_ENV['DB_PORT'],
            'dbname' => $_ENV['DB_DATABASE'],
            'user' => $_ENV['DB_USERNAME'],
            'password' => $_ENV['DB_PASSWORD'],
            'charset' => $_ENV['DB_CHARSET'],
        )));

    $container->addShared(\Doctrine\DBAL\Connection::class, function() use ($container): \Doctrine\DBAL\Connection {
       return $container->get(meowprd\FelinePHP\Database\ConnectionFactory::class)->create();
    });
};