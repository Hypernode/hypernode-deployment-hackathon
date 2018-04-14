<?php

namespace Hypernode\Deployment\Console\Command;

use Magento\MagentoCloud\Environment;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
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
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(
        LoggerInterface $logger = null
    ) {
        $this->logger = $logger ?: new Logger('default');

        parent::__construct();
    }

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName(static::NAME)
            ->setDescription('Builds the Magento 2 application');

        parent::configure();
    }

    /**
     * @inheritdoc
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $this->logger->info('Starting Hypernode Magento 2 build sequence.');

            //TODO: Implement nessesary build methods

            $this->logger->info('Hypernode Magento 2 build sequence completed.');
        } catch (\Exception $exception) {
            $this->logger->critical($exception->getMessage());

            throw $exception;
        }
    }
    
}