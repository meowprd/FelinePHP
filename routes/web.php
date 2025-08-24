<?php

use App\Controllers\IndexController;
use meowprd\FelinePHP\Http\Response;
use meowprd\FelinePHP\Routing\Route;

return array(
    Route::get('/', array(IndexController::class, "index"), array(\App\Middlewares\TestMiddleware::class))
);