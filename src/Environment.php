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

    const MAGENTO_ROOT = __DIR__ . '/../../../../';
    const CONFIGURATION_FILE = '.hypernode.build.yml';

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

    /**
     * @return \Psr\Log\LoggerInterface
     */
    public function getLogger(): \Psr\Log\LoggerInterface
    {
        return $this->logger;
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        if (!$this->config) {
            if(!file_exists(self::MAGENTO_ROOT.self::CONFIGURATION_FILE)) {
                throw new \Exception('.hypernode.build.yml configuration file not found');
            }

            $this->config = Yaml::parse(file_get_contents(self::MAGENTO_ROOT.self::CONFIGURATION_FILE));;
        }
        return $this->config;
    }

}