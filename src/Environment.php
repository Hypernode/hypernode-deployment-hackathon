<?php

namespace Hypernode\Deployment;

use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * Shared logic for build and deploy
 */
class Environment
{
    const CONFIGURATION_FILE = '.hypernode.ci.yml';

    /**
     * @var bool|string
     */
    public static $MAGENTO_ROOT;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var array
     */
    protected $config;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger = NULL)
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
     * @return LoggerInterface
     */
    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getConfig(): array
    {
        if (!$this->config) {
            if (file_exists(self::$MAGENTO_ROOT . self::CONFIGURATION_FILE)) {
                $this->config = Yaml::parse(file_get_contents(self::$MAGENTO_ROOT . DIRECTORY_SEPARATOR . self::CONFIGURATION_FILE));;
            } else {
                $this->logger->warning(sprintf('%s not found. Falling back to default configuration file', self::CONFIGURATION_FILE));
                $this->config = Yaml::parse(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . self::CONFIGURATION_FILE));
            }
        }

        return $this->config;
    }

}