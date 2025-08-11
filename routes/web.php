<?php

use App\Controllers\IndexController;
use meowprd\FelinePHP\Http\Response;
use meowprd\FelinePHP\Routing\Route;

return array(
    Route::get('/', array(IndexController::class, "index")),

    Route::post('/ping', function(){
        return new Response('Hello, World from web!');
    })

);