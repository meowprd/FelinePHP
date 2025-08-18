<?php

namespace meowprd\FelinePHP\Controller;

use meowprd\FelinePHP\Http\Response;
use Psr\Container\ContainerInterface;
use Twig\Environment;

abstract class AbstractController
{
    protected ?ContainerInterface $container = null;

    public function setContainer(ContainerInterface $container): void {
        $this->container = $container;
    }

    public function render(string $view, array $params = [], Response $response = null): Response {
        /** @var Environment $twig */
        $twig = $this->container->get('twig');
        $content = $twig->render($view, $params);

        $response ??= new Response($content);
        return $response;
    }
}