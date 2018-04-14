<?php

namespace Hypernode\Deployment\Tasks\Deploy\Builtin;

use Hypernode\Deployment;

class SetupUpgrade
    extends Deployment\Tasks\Task\AbstractTask
{

    public function run()
    {
        $this->environment->log('Hello World');
    }

}
