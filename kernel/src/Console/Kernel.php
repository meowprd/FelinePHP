<?php

namespace meowprd\FelinePHP\Console;

use DirectoryIterator;
use League\Container\Container;
use meowprd\FelinePHP\Exceptions\ConsoleException;
use ReflectionClass;
use Throwable;

/**
 * Console application kernel.
 *
 * Handles command registration, parsing, and execution.
 * @final
 */
final class Kernel
{
    /** @var array Registered commands metadata */
    private array $commands = [];

    public function __construct(
        private readonly Container $container,
    ) {
        $this->registerCommands();
    }

    /**
     * Handle the console command execution.
     *
     * @return int Exit status code (0 on success)
     * @throws ConsoleException On command execution failure
     */
    public function handle(): int
    {
        $argv = $_SERVER['argv'];
        $commandName = $argv[1] ?? null;

        if (null === $commandName) {
            $this->displayAvailableCommands();
            return 1;
        }

        return $this->executeCommand($commandName, array_slice($argv, 2));
    }

    /**
     * Display list of available commands.
     */
    private function displayAvailableCommands(): void
    {
        echo Colors::LIGHT_YELLOW . 'List of available commands:' . Colors::RESET . PHP_EOL;

        foreach ($this->commands as $command => $params) {
            echo ' '
                . Colors::LIGHT_GREEN . str_pad($command, 25)
                . Colors::LIGHT_CYAN . str_pad($params['description'], 30)
                . Colors::RESET . PHP_EOL;
        }
    }

    /**
     * Execute a console command.
     *
     * @param string $commandName Command to execute
     * @param array $rawParams Raw command parameters
     * @return int Exit status code
     * @throws ConsoleException
     */
    private function executeCommand(string $commandName, array $rawParams): int
    {
        try {
            if (!isset($this->commands[$commandName])) {
                throw new ConsoleException("Command '{$commandName}' not found");
            }

            $command = $this->container->get($commandName);
            $params = $this->parseParams($rawParams);

            return $command->execute($params);
        } catch (Throwable $e) {
            throw new ConsoleException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Parse raw command line parameters into named options.
     *
     * @param array $params Raw parameters
     * @return array Parsed parameters (key-value pairs)
     */
    private function parseParams(array $params): array
    {
        $args = [];

        foreach ($params as $param) {
            if (str_starts_with($param, '--')) {
                $option = explode('=', substr($param, 2), 2);
                $args[$option[0]] = $option[1] ?? true;
            }
        }

        return $args;
    }

    /**
     * Register all available commands from the Commands directory.
     */
    private function registerCommands(): void
    {
        $commandsDir = __DIR__ . '/Commands';

        if (!is_dir($commandsDir)) {
            return;
        }

        foreach (new DirectoryIterator($commandsDir) as $file) {
            if (!$file->isFile() || $file->getExtension() !== 'php') {
                continue;
            }

            $className = 'meowprd\\FelinePHP\\Console\\Commands\\' . $file->getBasename('.php');

            if (is_subclass_of($className, CommandInterface::class)) {
                $this->registerCommand($className);
            }
        }
    }

    /**
     * Register a single command with the container.
     *
     * @param string $className Fully qualified command class name
     */
    private function registerCommand(string $className): void
    {
        $reflection = new ReflectionClass($className);

        $commandName = $reflection->getProperty('command')->getDefaultValue();
        $description = $reflection->getProperty('description')->getDefaultValue();

        $this->container->addShared($commandName, fn() => $this->container->get($className));

        $this->commands[$commandName] = [
            'description' => $description,
            'class' => $className
        ];
    }
}