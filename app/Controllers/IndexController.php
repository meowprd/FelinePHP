<?php

namespace App\Controllers;

use meowprd\FelinePHP\Controller\AbstractController;
use meowprd\FelinePHP\Http\Response;

class IndexController extends AbstractController
{
    public function __construct() {}

    public function index(): Response {
        dd($this->request->session()->getId());
        return $this->render("index.html.twig");
    }
}