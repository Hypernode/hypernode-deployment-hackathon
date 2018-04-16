<?php

namespace Hypernode\Deployment\Tasks\Deploy\Builtin;

use Exception;
use Hypernode\Deployment;
use Symfony\Component\Console\Input\ArrayInput;

class SetupUpgrade extends Deployment\Tasks\Task\AbstractTask
{
    /**
     * @return void
     */
    public function run()
    {
        $this->environment->log('Executing Setup Upgrade command...');

        try {
            $this->environment->log(
                $this->runCommand(
                    new ArrayInput(
                        [
                            'command' => 'setup:upgrade',
                            '--keep-generated' => true
                        ]
                    )
                )->fetch()
            );
        } catch (Exception $e) {
            $this->environment->getLogger()->error($e->getMessage());
        }
    }
}
