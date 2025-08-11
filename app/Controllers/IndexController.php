<?php

namespace App\Controllers;

use meowprd\FelinePHP\Http\Response;

class IndexController
{
    public function index() {
        return new Response('Hello, World from IndexController!');
    }
}