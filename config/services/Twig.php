<?php

return function(League\Container\Container $container) {
    $container->add('twig-factory', \meowprd\FelinePHP\Template\TwigFactory::class)
        ->addArgument(\meowprd\FelinePHP\Http\Session::class);

    $container->addShared('twig', function() use ($container): \Twig\Environment {
        return $container->get('twig-factory')->create();
    });
};