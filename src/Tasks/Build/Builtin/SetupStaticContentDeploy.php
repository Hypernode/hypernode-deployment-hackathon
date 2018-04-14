<?php

namespace Hypernode\Deployment\Tasks\Build\Builtin;

use Magento\Framework;
use Magento\Deploy;
use Hypernode\Deployment;
use Symfony\Component\Console;

class SetupStaticContentDeploy
    extends Deployment\Tasks\Task\AbstractTask
{

    const CMD_NAME_STATIC_CONTENT_DEPLOY = 'setup:static-content:deploy';

    public function run()
    {
        try {
            $this->environment->log('Executing static content deploy...');
            $this->environment->log(
                $this->runCommand(
                    $this->getStaticContentDeployArrayInput([Framework\App\Area::AREA_FRONTEND])
                )->fetch()
            );
            $this->environment->log(
                $this->runCommand(
                    $this->getStaticContentDeployArrayInput([Framework\App\Area::AREA_ADMINHTML])
                )->fetch()
            );
        } catch (\Error $e) {
            $this->environment->getLogger()->error($e->getMessage());

            return;
        } catch (\Exception $e) {
            $this->environment->getLogger()->error($e->getMessage());

            return;
        }

        try {
            $this->environment->log(sprintf('Moving compiled assets to %s', $this->getStaticDir()));
            Deployment\Assets\AssetMover::moveAssetDirectory($this->getStaticDir());
            $this->environment->log('Done moving compiled assets');
        } catch (\Error $e) {
            $this->environment->getLogger()->error($e->getMessage());
        } catch (\Exception $e) {
            $this->environment->getLogger()->error($e->getMessage());
        }
    }

    protected function getStaticDir(): string
    {
        $directories = Framework\App\Filesystem\DirectoryList::getDefaultConfig();

        return $directories[Framework\App\Filesystem\DirectoryList::STATIC_VIEW]['path'];
    }

    protected function getStaticContentDeployArrayInput(
        array $areas = [],
        array $themes = [],
        array $languages = []
    ): Console\Input\ArrayInput {
        $parameters = [];
        $parameters['command'] = self::CMD_NAME_STATIC_CONTENT_DEPLOY;
        $parameters['--' . Deploy\Console\DeployStaticOptions::FORCE_RUN] = true;

        if (count($areas) > 0) {
            $parameters['--' . Deploy\Console\DeployStaticOptions::AREA] = $areas;
        }

        if (count($themes) > 0) {
            $parameters['--' . Deploy\Console\DeployStaticOptions::THEME] = $themes;
        }

        if (count($languages) > 0) {
            $parameters['--' . Deploy\Console\DeployStaticOptions::LANGUAGES_ARGUMENT] = $languages;
        }

        return new Console\Input\ArrayInput($parameters);
    }

}