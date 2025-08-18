<?php

return function(League\Container\Container $container) {
    $container->addShared('twig-filesystemloader', \Twig\Loader\FilesystemLoader::class)
        ->addArgument(new \League\Container\Argument\Literal\StringArgument(VIEWS_PATH));

    $container->addShared('twig', \Twig\Environment::class)
        ->addArgument('twig-filesystemloader');
};