<?php

namespace Hypernode\Deployment\Console\Command;

use Exception;
use Hypernode\Deployment\Environment;
use Hypernode\Deployment\Tasks\Build\BuildTaskList;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * CLI command for building the application.
 */
class Build extends Command
{
    const NAME = 'hypernode:build';

    /**
     * @var Environment
     */
    protected $env;

    /**
     * Constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->env = new Environment();
        parent::__construct();
    }

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName(static::NAME)
            ->setDescription('Builds the Magento 2 application');

        parent::configure();
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return void
     *
     * @throws Exception
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $this->env->log('Starting Hypernode Magento 2 build sequence.');

            foreach (BuildTaskList::getTasks() as $buildTask) {
                $buildTask->setEnvironment($this->env)
                    ->setApplication($this->getApplication())
                    ->setParentCommand($this)
                    ->run();
            }

            $this->env->log('Hypernode Magento 2 build sequence completed.');
        } catch (Exception $exception) {
            $this->env->getLogger()->critical($exception->getMessage());

            throw $exception;
        }
    }
}
