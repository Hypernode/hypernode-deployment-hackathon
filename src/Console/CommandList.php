<?php

namespace Hypernode\Deployment\Console;

use Hypernode\Deployment\Console\Command\Build;
use Hypernode\Deployment\Console\Command\Deploy;
use Magento\Framework\ObjectManagerInterface;

/**
 * Class CommandList
 */
class CommandList implements \Magento\Framework\Console\CommandListInterface
{
    
    /**
     * Gets list of command classes
     *
     * @return string[]
     */
    protected function getCommandsClasses()
    {
        return [
            Build::class,
            Deploy::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getCommands()
    {
        $commands = [];
        foreach ($this->getCommandsClasses() as $class) {
            if (class_exists($class)) {
                $commands[] = new $class();
            } else {
                throw new \Exception('Class ' . $class . ' does not exist');
            }
        }
        return $commands;
    }
}