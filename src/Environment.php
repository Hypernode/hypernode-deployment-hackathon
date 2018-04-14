<?php

namespace Hypernode\Deployment;

use Monolog\Logger;
use Psr\Log\LoggerInterface;

/**
 * Shared logic for build and deploy
 */
class Environment
{

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger = null)
    {
        $this->logger = $logger ?: new Logger('default');

    }

    /**
     * @param string $message
     * @return void
     */
    public function log($message)
    {
        $this->logger->notice($message);
    }

}
