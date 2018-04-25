<?php

namespace Hypernode\Deployment\Tasks\Deploy\Builtin;

use Exception;
use Hypernode\Deployment;
use Magento\Deploy\Console\DeployStaticOptions;
use Symfony\Component\Console\Input\ArrayInput;

class SetupStaticContentDeploy extends Deployment\Tasks\Task\AbstractTask
{

    const CMD_NAME_STATIC_CONTENT_DEPLOY = 'setup:static-content:deploy';

    /**
     * Generate static content if not generated during build.
     * This should NOT be run on live websites. Only for development phase.
     *
     * @return void
     */
    public function run()
    {
        if (!file_exists($this->environment->getProjectRoot() . $this->environment->getStaticDirInit())) {
            $this->environment->getLogger()->warning(
                'Start generating static content. This should NOT be run on live websites. Only for development phase.'
            );
            try {
                $this->environment->log(
                    $this->runCommand(
                        new ArrayInput(
                            [
                                'command'                               => self::CMD_NAME_STATIC_CONTENT_DEPLOY,
                                '--' . DeployStaticOptions::FORCE_RUN   => true,
                                '--' . DeployStaticOptions::JOBS_AMOUNT =>
                                    $this->environment->getConfig()['static-content']['jobs'] ?? 1,
                            ]
                        )
                    )->fetch()
                );
            } catch (Exception $e) {
                $this->environment->getLogger()->error($e->getMessage());
            }
        }
    }

}
