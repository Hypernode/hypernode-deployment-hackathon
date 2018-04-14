<?php

namespace Hypernode\Deployment\Tasks;

use Hypernode\Deployment;

interface TaskListInterface
{

    /**
     * @return \Hypernode\Deployment\Tasks\Task\TaskInterface[]
     */
    public static function getTasks(): array;

    /**
     * @param \Hypernode\Deployment\Build\Tasks\Task\AbstractTask $task
     *
     * @return \Hypernode\Deployment\Tasks\TaskListInterface
     */
    public static function registerTask(
        Deployment\Tasks\Task\AbstractTask $task
    );

}