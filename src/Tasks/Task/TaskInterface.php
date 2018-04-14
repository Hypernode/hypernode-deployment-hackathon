<?php

namespace Hypernode\Deployment\Tasks\Task;

interface TaskInterface
{

    public function getSortOrder(): int;

    /**
     * @return void
     */
    public function run();

}