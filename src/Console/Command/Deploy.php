<?php

namespace Hypernode\Deployment\Console\Command;

use Hypernode\Deployment\Environment;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * CLI command for deploying the application.
 */
class Deploy extends Command
{
    const NAME = 'hypernode:deploy';

    /**
     * @var \Hypernode\Deployment\Environment
     */
    protected $env;

    /**
     * @inheritdoc
     */
    public function __construct() {
        $this->env = new Environment();

        parent::__construct();
    }

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName(static::NAME)
            ->setDescription('Deploys the Magento 2 application');

        parent::configure();
    }

    /**
     * @inheritdoc
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $this->env->log('Starting Hypernode Magento 2 deploy sequence.');

            foreach (\Hypernode\Deployment\Tasks\Deploy\DeployTaskList::getTasks() as $deployTask) {
                $deployTask->setEnvironment($this->env);
                $deployTask->setApplication($this->getApplication());
                $deployTask->run();
            }

            $this->env->log('Hypernode Magento 2 deploy sequence completed.');
        } catch (\Exception $exception) {
            $this->logger->critical($exception->getMessage());

            throw $exception;
        }
    }

}
