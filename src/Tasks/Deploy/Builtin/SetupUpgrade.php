<?php

namespace Hypernode\Deployment\Tasks\Deploy\Builtin;

use Exception;
use Hypernode\Deployment;
use Symfony\Component\Console\Input\ArrayInput;

class SetupUpgrade extends Deployment\Tasks\Task\AbstractTask
{

    const DB_UPDATE_NEEDED_EXIT_CODE = 2;

    /**
     * @return void
     */
    public function run()
    {
        $this->environment->log('Executing Setup Upgrade command...');

        if (version_compare($this->environment->getMagentoVersion(), '2.2.0', '<')) {
            $this->Magento21Update();
        } else {
            $this->Magento22Update();
        }
    }

    /**
     * Magento 2.1 dull update
     */
    protected function magento21Update()
    {
        $this->runSetupUpgrade();
    }

    /**
     * Magento 2.2 smart update
     */
    protected function magento22Update()
    {
        if ($this->getDatabaseUpgradeNeeded()) {
            $this->runSetupUpgrade();
        } else {
            $this->environment->log('Skipping setup:upgrade -> all modules up to date');
        }
    }

    /**
     * Run setup:upgrade --keep-generated command
     */
    protected function runSetupUpgrade()
    {
        try {
            $this->environment->log(
                $this->runCommand(
                    new ArrayInput(
                        [
                            'command'          => 'setup:upgrade',
                            '--keep-generated' => true,
                            '--no-interaction' => true,
                        ]
                    )
                )->fetch()
            );
        } catch (Exception $e) {
            $this->environment->getLogger()->error($e->getMessage());
        }
    }

    /**
     * Checks if database update needs to happen > 2.2.0 only
     *
     * @return bool
     */
    protected function getDatabaseUpgradeNeeded(): bool
    {
        try {
            $this->runCommand(new ArrayInput(['command' => 'setup:db:status']))->fetch();
            return $this->exitCode === self::DB_UPDATE_NEEDED_EXIT_CODE;
        } catch (Exception $e) {
            $this->environment->getLogger()->error($e->getMessage());
        }

        return true;
    }

}
