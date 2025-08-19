<?php

namespace meowprd\FelinePHP\Console;

use Doctrine\DBAL\Connection;
use League\Container\Container;
use meowprd\FelinePHP\Exceptions\ConsoleException;
use PHPUnit\Util\Color;

class Kernel
{
    private array $commands = array();

    public function __construct(
        private readonly Container $container,
    ) { $this->registerCommands(); }

    /**
     * @throws ConsoleException
     */
    public function handle(): int {
        $argv = $_SERVER['argv'];
        $cmd = $argv[1] ?? null;
        if(is_null($cmd)) {
            echo Colors::LIGHT_YELLOW . 'List of available commands:' . Colors::RESET .PHP_EOL;
            foreach($this->commands as $command => $params) {
                echo ' '
                    . Colors::LIGHT_GREEN . str_pad($command, 25)
                    . Colors::LIGHT_CYAN . str_pad($params['description'], 30)
                    . Colors::RESET . PHP_EOL;
            }
            return 1;
        }

        try {
            $command = $this->container->get($cmd);
            $command->execute($this->parseParams(array_slice($argv, 2)));
        } catch (\Throwable $e) {
            throw new ConsoleException($e->getMessage());
        }

        echo(Colors::RESET);
        return 0;
    }

    private function parseParams(array $params): array {
        $args = array();
        foreach($params as $param) {
            if(str_starts_with($param, '--')) {
                $option = explode('=', substr($param, 2));
                $args[$option[0]] = $option[1];
            }
        }
        return $args;
    }

    private function registerCommands() {
        $files = new \DirectoryIterator(__DIR__ . '/Commands');
        foreach ($files as $file) {
            if(!$file->isFile()) { continue; }
            $command = 'meowprd\\FelinePHP\\Console\\Commands\\' . $file->getBasename('.php');
            if(is_subclass_of($command, CommandInterface::class)) {
                $reflection = new \ReflectionClass($command);
                $cmd = $reflection->getProperty('command')->getDefaultValue();
                $desc = $reflection->getProperty('description')->getDefaultValue();
                $container = $this->container;
                $this->container->addShared($cmd, function() use ($container, $command){ return $container->get($command); });
                $this->commands[$cmd] = array(
                    'description' => $desc,
                    'provided' => $command
                );
            }
        }
    }
}