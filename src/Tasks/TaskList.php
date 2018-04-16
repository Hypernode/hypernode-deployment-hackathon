<?php

namespace Hypernode\Deployment\Tasks;

use Hypernode\Deployment\Tasks\Task\AbstractTask;
use Hypernode\Deployment\Tasks\Task\TaskInterface;

abstract class TaskList implements TaskListInterface
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
     * @return TaskInterface[]|AbstractTask[]
     */
    public static function getTasks(): array
    {
        static::resort();
        return static::$taskList[static::$type];
    }

    /**
     * @return void
     */
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

    /**
     * @param AbstractTask $task
     *
     * @return void
     */
    public static function registerTask(AbstractTask $task)
    {
        static::$taskList[static::$type][] = $task;
    }

    /**
     * @param AbstractTask[] ...$tasks
     *
     * @return void
     */
    public static function registerTasks(AbstractTask ... $tasks)
    {
        foreach ($tasks as $task) {
            static::registerTask($task);
        }
    }
}
