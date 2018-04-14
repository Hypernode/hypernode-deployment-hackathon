<?php

namespace Hypernode\Deployment;

use Monolog\Logger;
use Psr\Log\LoggerInterface;

/**
 * Shared logic for build and deploy
 */
class Environment
{

    public static $MAGENTO_ROOT;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger = null)
    {
        self::$MAGENTO_ROOT = realpath(__DIR__ . '/../../../..');
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

    /**
     * @return \Psr\Log\LoggerInterface
     */
    public function getLogger(): \Psr\Log\LoggerInterface
    {
        return $this->logger;
    }

}