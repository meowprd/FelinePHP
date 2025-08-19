<?php

namespace App\Controllers;

use meowprd\FelinePHP\Controller\AbstractController;
use meowprd\FelinePHP\Http\Response;

class {{ class }} extends AbstractController
{
    public function __construct(
        // inject services
    ) {}

    public function index(): Response {
        dump($this);
        return new Response('response');
    }
}