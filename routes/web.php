<?php

use meowprd\FelinePHP\Http\Response;
use meowprd\FelinePHP\Routing\Route;

use App\Controllers\IndexController;

return array(
    Route::get('/', array(IndexController::class, "index")),

    Route::post('/ping', function(){
        return new Response('Hello, World from web!');
    })

);