<?php

namespace meowprd\FelinePHP\Controller;

use meowprd\FelinePHP\Http\Response;
use Psr\Container\ContainerInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Abstract base controller providing common functionality for all controllers.
 *
 * This class handles dependency injection container setup and provides basic view rendering capabilities.
 */
abstract class AbstractController
{
    /** @var ContainerInterface|null Dependency injection container instance */
    protected ?ContainerInterface $container = null;

    /**
     * Sets the dependency injection container.
     *
     * @param ContainerInterface $container The container instance
     */
    public function setContainer(ContainerInterface $container): void
    {
        $this->container = $container;
    }

    /**
     * Renders a view template and returns a Response object.
     *
     * @param string $view Template path
     * @param array $params Template parameters
     * @param Response|null $response Optional response object to modify
     * @return Response
     * @throws LoaderError When the template cannot be found
     * @throws RuntimeError When an error occurred during rendering
     * @throws SyntaxError When template syntax is invalid
     * @throws \Psr\Container\ContainerExceptionInterface If the Twig service cannot be retrieved
     */
    public function render(string $view, array $params = [], ?Response $response = null): Response
    {
        if (null === $this->container) {
            throw new \RuntimeException('Container has not been set on the controller');
        }

        /** @var Environment $twig */
        $twig = $this->container->get('twig');
        $content = $twig->render($view, $params);

        $response ??= new Response($content);
        return $response;
    }
}