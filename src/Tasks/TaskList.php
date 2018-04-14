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
        return static::$taskList[static::$type];
    }

    public static function resort()
    {
        usort(
            static::$taskList[static::$type],
            function (
                Deployment\Tasks\Task\AbstractTask $a,
                Deployment\Tasks\Task\AbstractTask $b
            ) {
                return $a->getSortOrder() <=> $b->getSortOrder();
            }
        );
    }

    public static function registerTask(
        Deployment\Tasks\Task\AbstractTask $task
    ) {
        static::$taskList[static::$type][] = $task;
        static::resort();
    }

    public static function registerTasks(
        Deployment\Tasks\Task\AbstractTask ... $tasks
    ) {
        foreach ($tasks as $task) {
            static::registerTask($task);
        }

        static::resort();
    }

}