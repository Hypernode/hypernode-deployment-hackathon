<?php

namespace Hypernode\Deployment\Tasks;

use Hypernode\Deployment;

abstract class TaskList
    implements TaskListInterface
{

    /**
     * @var array
     */
    protected static $taskList = [];

    /**
     * @var string
     */
    protected static $type = null;

    /**
     * @return \Hypernode\Deployment\Tasks\Task\TaskInterface[]|\Hypernode\Deployment\Tasks\Task\AbstractTask[]
     */
    public static function getTasks(): array
    {
        return self::$taskList[self::$type];
    }

    public static function registerTask(
        Deployment\Tasks\Task\AbstractTask $task
    ) {
        self::$taskList[self::$type][] = $task;
    }

}