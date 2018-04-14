<?php

namespace Hypernode\Deployment\Build\Task;

interface BuildTaskInterface
{

    public function getSortOrder(): int;

    /**
     * @return void
     */
    public function run();

}