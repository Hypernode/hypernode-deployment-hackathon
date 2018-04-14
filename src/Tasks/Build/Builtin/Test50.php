<?php

namespace Hypernode\Deployment\Tasks\Build\Builtin;

use Hypernode\Deployment;

class Test50
    extends Deployment\Tasks\Task\AbstractTask
{

    public function run()
    {
        $this->environment->log('Test 50');
    }

}