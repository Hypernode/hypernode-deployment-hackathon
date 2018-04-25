<?php

namespace Hypernode\Deployment\Tasks\Task;

use Exception;
use Hypernode\Deployment\Environment;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\BufferedOutput;

abstract class AbstractTask implements TaskInterface
{
    /**
     * @var Environment
     */
    protected $environment;

    /**
     * @var Command
     */
    protected $parentCommand;

    /**
     * @var Application
     */
    protected $application;

    /*
     * runCommand exit code
     */
    protected $exitCode;

    /**
     * @var int
     */
    private $sortOrder = 99999;

    /**
     * Constructor.
     *
     * @param int $sortOrder
     */
    public function __construct(int $sortOrder = 99999)
    {
        $this->sortOrder = $sortOrder;
    }

    /**
     * @param Environment $environment
     *
     * @return AbstractTask
     */
    public function setEnvironment(Environment $environment): AbstractTask
    {
        $this->environment = $environment;
        return $this;
    }

    /**
     * @param Command $parentCommand
     *
     * @return AbstractTask
     */
    public function setParentCommand(Command $parentCommand): AbstractTask
    {
        $this->parentCommand = $parentCommand;
        return $this;
    }

    /**
     * @param Application $application
     *
     * @return AbstractTask
     */
    public function setApplication(Application $application): AbstractTask
    {
        $this->application = $application;
        return $this;
    }

    /**
     * @return int
     */
    public function getSortOrder(): int
    {
        return $this->sortOrder;
    }

    /**
     * @param InputInterface $input
     * @return BufferedOutput
     *
     * @throws Exception
     */
    protected function runCommand(InputInterface $input): BufferedOutput
    {
        $output = new BufferedOutput();
        $application = clone $this->application;
        $application->setAutoExit(false);
        $this->exitCode = $application->run($input, $output);

        return $output;
    }
}
