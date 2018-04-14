<?php

namespace Hypernode\Deployment\Tasks\Build\Builtin;

use Hypernode\Deployment;

class Test20
    extends Deployment\Tasks\Task\AbstractTask
{

    public function run()
    {
        $this->environment->log('Test 20');
    }

}