<?php

return function (League\Container\Container $container) {
    $container->addShared(\meowprd\FelinePHP\Event\EventDispatcher::class);

    /** @var \meowprd\FelinePHP\Event\EventDispatcher $eventDispatcher */
    $eventDispatcher = $container->get(\meowprd\FelinePHP\Event\EventDispatcher::class);

    //$eventDispatcher->addListener();
};