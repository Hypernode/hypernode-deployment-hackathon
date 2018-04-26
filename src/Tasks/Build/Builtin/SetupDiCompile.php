<?php

namespace Hypernode\Deployment\Tasks\Build\Builtin;

use Error;
use Exception;
use Hypernode\Deployment\Assets\AssetMover;
use Hypernode\Deployment\Tasks\Task\AbstractTask;
use Symfony\Component\Console\Input\ArrayInput;

class SetupDiCompile extends AbstractTask
{
    /**
     * @return void
     */
    public function run()
    {
        try {
            $this->environment->log('Executing DI compile...');
            $this->environment->log(
                $this->runCommand(new ArrayInput(['command' => 'setup:di:compile']))->fetch()
            );
        } catch (Error $e) {
            $this->environment->getLogger()->error($e->getMessage());

            return;
        } catch (Exception $e) {
            $this->environment->getLogger()->error($e->getMessage());

            return;
        }

        try {
            $this->environment->log(
                sprintf('Moving compiled assets to %s', $this->environment->getGeneratedCodeDir())
            );
            // TODO change?
            AssetMover::moveAssetDirectory(
                $this->environment->getProjectRoot() . $this->environment->getGeneratedCodeDir(),
                $this->environment->getProjectRoot() . $this->environment->getGeneratedCodeDirInit()
            );
            AssetMover::moveAssetDirectory(
                $this->environment->getProjectRoot() . $this->environment->getGeneratedMetadataDir(),
                $this->environment->getProjectRoot() . $this->environment->getGeneratedMetadataDirInit()
            );
            $this->environment->log('Done moving compiled assets');
        } catch (Error $e) {
            $this->environment->getLogger()->error($e->getMessage());
        } catch (Exception $e) {
            $this->environment->getLogger()->error($e->getMessage());
        }
    }
}
