<?php

namespace Hypernode\Deployment\Tasks\Task;

interface TaskInterface
{
    /**
     * @return int
     */
    public function getSortOrder(): int;

    /**
     * @return void
     */
    public function run();
}
