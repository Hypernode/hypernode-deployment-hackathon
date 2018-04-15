<?php

namespace Hypernode\Deployment\Console;

use Exception;
use Hypernode\Deployment\Console\Command\Build;
use Hypernode\Deployment\Console\Command\Deploy;
use Magento\Framework\Console\CommandListInterface;

/**
 * Class CommandList
 */
class CommandList implements CommandListInterface
{
    /**
     * Gets list of command classes
     *
     * @return string[]
     */
    protected function getCommandsClasses(): array
    {
        return [
            Build::class,
            Deploy::class
        ];
    }

    /**
     * @return array
     *
     * @throws Exception
     */
    public function getCommands(): array
    {
        $commands = [];
        foreach ($this->getCommandsClasses() as $class) {
            if (class_exists($class)) {
                $commands[] = new $class();
            } else {
                throw new Exception('Class ' . $class . ' does not exist');
            }
        }

        return $commands;
    }
}
