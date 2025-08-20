<?php

namespace meowprd\FelinePHP\Template;

use meowprd\FelinePHP\Http\Session;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

/**
 * Factory for creating and configuring Twig environment instances.
 *
 * Handles Twig initialization with proper settings, extensions, and custom functions.
 * Provides integration with application components like session management.
 */
class TwigFactory
{
    /**
     * Constructor.
     *
     * @param Session $session Session instance for template integration
     */
    public function __construct(
        private readonly Session $session
    ) {}

    /**
     * Create and configure Twig environment.
     *
     * @return Environment Configured Twig instance
     * @throws \Twig\Error\LoaderError If loader configuration is invalid
     */
    public function create(): Environment
    {
        $loader = new FilesystemLoader(VIEWS_PATH);

        $twig = new Environment($loader, [
            'debug' => $_ENV['DEBUG'],
            'cache' => false,
        ]);

        if ($_ENV['DEBUG']) {
            $twig->addExtension(new DebugExtension());
        }

        $this->addCustomFunctions($twig);
        $this->addGlobals($twig);

        return $twig;
    }

    /**
     * Add custom functions to Twig environment.
     *
     * @param Environment $twig Twig environment instance
     * @return void
     */
    private function addCustomFunctions(Environment $twig): void
    {
        // Session access function
        $twig->addFunction(new TwigFunction('session', [$this, 'getSession']));

        // Environment variable access function
        $twig->addFunction(new TwigFunction('env', function (string $key, $default = null) {
            return $_ENV[$key] ?? $default;
        }));
    }

    /**
     * Get session instance for Twig templates.
     *
     * @return Session Session instance
     */
    public function getSession(): Session
    {
        return $this->session;
    }

    /**
     * Add global variables to Twig environment.
     *
     * @param Environment $twig Twig environment instance
     * @return void
     */
    private function addGlobals(Environment $twig): void
    {
        // Example global variables
        $twig->addGlobal('app_name', $_ENV['APP_NAME'] ?? 'FelinePHP');
    }
}