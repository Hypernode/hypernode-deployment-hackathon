<?php

namespace Hypernode\Deployment\Tasks;

use Hypernode\Deployment\Tasks\Task\TaskInterface;
use Hypernode\Deployment\Tasks\Task\AbstractTask;

interface TaskListInterface
{
    /**
     * @return TaskInterface[]
     */
    public static function getTasks(): array;

    /**
     * @param AbstractTask $task
     *
     * @return void
     */
    public static function registerTask(AbstractTask $task);

    /**
     * @param AbstractTask[] ...$tasks
     *
     * @return void
     */
    public static function registerTasks(AbstractTask ...$tasks);
}
