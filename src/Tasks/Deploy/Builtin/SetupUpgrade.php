<?php

namespace Hypernode\Deployment\Tasks\Deploy\Builtin;

use Hypernode\Deployment;
use Symfony\Component\Console;

class SetupUpgrade
    extends Deployment\Tasks\Task\AbstractTask
{

    public function run()
    {
        $this->environment->log('Executing DI compile...');

        try {
            $this->environment->log(
                $this->runCommand(new Console\Input\ArrayInput(['command' => 'setup:upgrade']))->fetch()
            );
        } catch (\Exception $e) {
            $this->environment->getLogger()->error($e->getMessage());
        }
    }

}
