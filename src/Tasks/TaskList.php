<?php

namespace Hypernode\Deployment\Tasks;

use Hypernode\Deployment\Tasks\Task\AbstractTask;

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
        static::resort();
        return static::$taskList[static::$type];
    }

    public static function resort()
    {
        usort(
            static::$taskList[static::$type],
            function (
                AbstractTask $a,
                AbstractTask $b
            ) {
                return $a->getSortOrder() <=> $b->getSortOrder();
            }
        );
    }

    public static function registerTask(
        AbstractTask ... $tasks
    ) {
        static::$taskList[static::$type][] = $task;
    }

    public static function registerTasks(
        AbstractTask ... $tasks
    ) {
        foreach ($tasks as $task) {
            static::registerTask($task);
        }
    }

}
