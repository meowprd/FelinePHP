<?php

return function (League\Container\Container $container) {
    $container->addShared(\meowprd\FelinePHP\Http\Session::class);
};