<?php

namespace Hypernode\Deployment\Build\Task;

use Hypernode\Deployment;

class BuildTaskList
{

    /**
     * @var array
     */
    protected static $taskList = [];

    /**
     * @return \Hypernode\Deployment\Build\Task\BuildTaskInterface[]|\Hypernode\Deployment\Build\Task\AbstractBuildTask[]
     */
    public static function getTaskList(): array
    {
        return self::$taskList;
    }

    public static function registerTask(
        AbstractBuildTask $abstractBuildTask
    ) {
        self::$taskList[] = $abstractBuildTask;
    }

}