<?php

namespace Hypernode\Deployment;

use Exception;
use Magento\Framework\App\Filesystem\DirectoryList;
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
     * @var string
     */
    protected $projectRoot;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var array
     */
    protected $config;

    /**
     * Constructor.
     *
     * @param LoggerInterface|null $logger
     *
     * @throws Exception
     */
    public function __construct(LoggerInterface $logger = NULL)
    {
        $this->logger = $logger ?: new Logger('default');

        // TODO Check if there is an other solution for getting the Projects root path
        $rootPath = realpath(__DIR__ . '/../../../..');
        if (false === $rootPath) {
            $message = 'Could not find Projects root path';
            $this->getLogger()->critical($message);
            throw new Exception($message);
        }

        if (substr($rootPath, -1) !== DIRECTORY_SEPARATOR) {
            $rootPath .= DIRECTORY_SEPARATOR;
        }

        $this->projectRoot = $rootPath;
    }

    /**
     * @param string $message
     *
     * @return void
     */
    public function log(string $message)
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
     *
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

    /**
     * @return string
     */
    public function getProjectRoot(): string
    {
        return $this->projectRoot;
    }

    /**
     * @return string
     */
    public function getConfigurationFilePath(): string
    {
        return $this->getProjectRoot() . self::CONFIGURATION_FILE;
    }

    /**
     * @return string
     */
    public function getInitPath(): string
    {
        return '.init' . DIRECTORY_SEPARATOR;
    }

    /**
     * @return string
     */
    public function getGeneratedCodeDir(): string
    {
        $directories = DirectoryList::getDefaultConfig();
        return $directories[DirectoryList::GENERATED_CODE]['path'];
    }

    /**
     * @return string
     */
    public function getGeneratedCodeDirInit(): string
    {
        return $this->getInitPath() . 'generated' . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR;
    }

    /**
     * @return string
     */
    public function getStaticDir(): string
    {
        $directories = DirectoryList::getDefaultConfig();
        return $directories[DirectoryList::STATIC_VIEW]['path'];
    }

    /**
     * @return string
     */
    public function getStaticDirInit(): string
    {
        return $this->getInitPath() . 'static' . DIRECTORY_SEPARATOR;
    }
}
