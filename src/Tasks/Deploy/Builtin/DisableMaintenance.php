<?php

namespace Hypernode\Deployment\Tasks\Deploy\Builtin;

use Exception;
use Hypernode\Deployment;
use Symfony\Component\Console\Input\ArrayInput;

class DisableMaintenance extends Deployment\Tasks\Task\AbstractTask
{

    /**
     * @return void
     */
    public function run()
    {
        $this->environment->log('Disabling maintenance mode...');

        try {
            $this->environment->log(
                $this->runCommand(
                    new ArrayInput(
                        [
                            'command' => 'maintenance:disable',
                        ]
                    )
                )->fetch()
            );
        } catch (Exception $e) {
            $this->environment->getLogger()->error($e->getMessage());
        }
    }

}
