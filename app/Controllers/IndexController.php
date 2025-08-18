<?php

namespace App\Controllers;

use meowprd\FelinePHP\Controller\AbstractController;
use meowprd\FelinePHP\Http\Response;

class IndexController extends AbstractController
{
    public function index() {
        dd($this->container->get('twig'));
        return new Response('Hello, World from IndexController!');
    }
}