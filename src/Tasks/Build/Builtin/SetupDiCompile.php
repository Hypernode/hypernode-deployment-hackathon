<?php

namespace Hypernode\Deployment\Tasks\Build\Builtin;

use Hypernode\Deployment;
use Symfony\Component\Console;

class SetupDiCompile
    extends Deployment\Tasks\Task\AbstractTask
{

    public function run()
    {
        $this->environment->log('Executing DI compile...');

        try {
            $this->environment->log(
                $this->runCommand(new Console\Input\ArrayInput(['command' => 'setup:di:compile']))->fetch()
            );
        } catch (\Exception | \Error $e) {
            $this->environment->getLogger()->error($e->getMessage());
        }
    }

}