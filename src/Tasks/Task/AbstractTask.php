<?php

namespace Hypernode\Deployment\Tasks\Task;

use Hypernode\Deployment;

abstract class AbstractTask
    implements Deployment\Tasks\Task\TaskInterface
{

    /**
     * @var Deployment\Environment
     */
    protected $environment;

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

    public function getSortOrder(): int
    {
        return $this->sortOrder;
    }

}