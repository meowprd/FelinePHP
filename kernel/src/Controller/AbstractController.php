<?php

namespace meowprd\FelinePHP\Controller;

use meowprd\FelinePHP\Http\Request;
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
    /**
     * @var ContainerInterface|null Dependency injection container instance
     */
    protected ?ContainerInterface $container = null;

    /**
     * @var Request|null HTTP request instance
     */
    protected ?Request $request = null;

    /**
     * Sets the dependency injection container.
     *
     * @param ContainerInterface $container The container instance
     * @return void
     */
    public function setContainer(ContainerInterface $container): void
    {
        $this->container = $container;
    }

    /**
     * Sets the HTTP request instance.
     *
     * @param Request $request The request instance
     * @return void
     */
    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    /**
     * Renders a view template and returns a Response object.
     *
     * @param string $view Template path relative to templates directory
     * @param array<string, mixed> $params Template parameters (key-value pairs)
     * @param Response|null $response Optional response object to modify instead of creating new one
     * @return Response Response object with rendered content
     * @throws LoaderError When the template cannot be found
     * @throws RuntimeError When an error occurred during rendering
     * @throws SyntaxError When template syntax is invalid
     * @throws \Psr\Container\ContainerExceptionInterface If the Twig service cannot be retrieved
     * @throws \RuntimeException When container has not been set
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