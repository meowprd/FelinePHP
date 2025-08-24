<?php

use meowprd\FelinePHP\Http\Response;
use meowprd\FelinePHP\Routing\Route;

return array(
    Route::get('/ping', function(){ return new Response('Hello, World from api!'); }, array(\App\Middlewares\TestMiddleware::class)),
);