<?php

namespace Hypernode\Deployment\Tasks\Deploy\Builtin;

use Hypernode\Deployment;
use Symfony\Component\Console;

class SetupUpgrade
    extends Deployment\Tasks\Task\AbstractTask
{

    public function run()
    {
        $this->environment->log('Executing Setup Upgrade command...');

        try {
            $this->environment->log(
                $this->runCommand(new Console\Input\ArrayInput(['command' => 'setup:upgrade', '--keep-generated' => true]))->fetch()
            );
        } catch (\Exception $e) {
            $this->environment->getLogger()->error($e->getMessage());
        }
    }

}
