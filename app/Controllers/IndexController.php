<?php

namespace App\Controllers;

use meowprd\FelinePHP\Controller\AbstractController;
use meowprd\FelinePHP\Http\Response;

class IndexController extends AbstractController
{
    public function index(): Response {
        return $this->render('index.html.twig', array(
            'testParam' => 'param string'
        ));
    }
}