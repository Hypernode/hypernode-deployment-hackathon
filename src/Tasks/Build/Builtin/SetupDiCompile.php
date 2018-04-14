<?php

namespace Hypernode\Deployment\Tasks\Build\Builtin;

use Hypernode\Deployment;

class SetupDiCompile
    extends Deployment\Tasks\Task\AbstractTask
{

    public function run()
    {
        $this->environment->log('Hello World');
    }

}