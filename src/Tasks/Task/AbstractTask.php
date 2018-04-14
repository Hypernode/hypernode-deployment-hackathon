<?php

namespace Hypernode\Deployment\Tasks\Task;

use Hypernode\Deployment;
use Symfony\Component\Console;

abstract class AbstractTask
    implements Deployment\Tasks\Task\TaskInterface
{

    /**
     * @var Deployment\Environment
     */
    protected $environment;

    /**
     * @var \Symfony\Component\Console\Application
     */
    protected $application;

    private $sortOrder = 99999;

    public function __construct(
        int $sortOrder = 99999
    ) {
        $this->sortOrder = $sortOrder;
    }

    public function setEnvironment(Deployment\Environment $environment)
    {
        $this->environment = $environment;
    }

    public function setApplication(Console\Application $application)
    {
        $this->application = $application;
    }

    public function getSortOrder(): int
    {
        return $this->sortOrder;
    }

    protected function runCommand(
        Console\Input\InputInterface $input
    ): Console\Output\OutputInterface {
        $output = new Console\Output\BufferedOutput();
        $application = clone $this->application;
        $application->setAutoExit(false);
        $application->run($input, $output);

        return $output;
    }

}