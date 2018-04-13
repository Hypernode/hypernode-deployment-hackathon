<?php

namespace Hypernode\Deployment\Console\Command;

use Magento\MagentoCloud\Environment;
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
            ->setDescription('Deploys the Magento 2 application');

        parent::configure();
    }

    /**
     * @inheritdoc
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $this->logger->info('Starting Hypernode Magento 2 deploy sequence.');

            //TODO: Implement nessesary deploy methods

            $this->logger->info('Hypernode Magento 2 deploy sequence completed.');
        } catch (\Exception $exception) {
            $this->logger->critical($exception->getMessage());

            throw $exception;
        }
    }

}