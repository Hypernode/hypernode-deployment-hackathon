<?php

namespace Hypernode\Deployment\Tasks\Deploy\Builtin;

use Exception;
use Hypernode\Deployment;
use Symfony\Component\Console\Input\ArrayInput;

class EnableMaintenance extends Deployment\Tasks\Task\AbstractTask
{

    /**
     * @return void
     */
    public function run()
    {
        $this->environment->log('Enabling maintenance mode...');

        try {
            $this->environment->log(
                $this->runCommand(
                    new ArrayInput(
                        [
                            'command' => 'maintenance:enable',
                        ]
                    )
                )->fetch()
            );
        } catch (Exception $e) {
            $this->environment->getLogger()->error($e->getMessage());
        }
    }

}
