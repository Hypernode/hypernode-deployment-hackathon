<?php

namespace Hypernode\Deployment\Tasks\Build\Builtin;

use Magento\Framework;
use Hypernode\Deployment;
use Symfony\Component\Console;

class SetupDiCompile
    extends Deployment\Tasks\Task\AbstractTask
{

    public function run()
    {
        try {
            $this->environment->log('Executing DI compile...');
            $this->environment->log(
                $this->runCommand(new Console\Input\ArrayInput(['command' => 'setup:di:compile']))->fetch()
            );
        } catch (\Error $e) {
            $this->environment->getLogger()->error($e->getMessage());

            return;
        } catch (\Exception $e) {
            $this->environment->getLogger()->error($e->getMessage());

            return;
        }

        try {
            $this->environment->log(sprintf('Moving compiled assets to %s', $this->getGeneratedCodeDir()));
            Deployment\Assets\AssetMover::moveAssetDirectory($this->getGeneratedCodeDir());
            $this->environment->log('Done moving compiled assets');
        } catch (\Error $e) {
            $this->environment->getLogger()->error($e->getMessage());
        } catch (\Exception $e) {
            $this->environment->getLogger()->error($e->getMessage());
        }
    }

    protected function getGeneratedCodeDir(): string
    {
        $directories = Framework\App\Filesystem\DirectoryList::getDefaultConfig();

        return $directories[Framework\App\Filesystem\DirectoryList::GENERATION]['path'];
    }

}