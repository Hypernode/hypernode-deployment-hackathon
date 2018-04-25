<?php

namespace Hypernode\Deployment\Tasks\Build\Builtin;

use Error;
use Exception;
use Hypernode\Deployment\Assets\AssetMover;
use Magento\Deploy\Console\DeployStaticOptions;
use Hypernode\Deployment\Tasks\Task\AbstractTask;
use Magento\Framework\App\Area;
use Symfony\Component\Console\Input\ArrayInput;

class SetupStaticContentDeploy extends AbstractTask
{
    const CMD_NAME_STATIC_CONTENT_DEPLOY = 'setup:static-content:deploy';

    /**
     * @return void
     */
    public function run()
    {
        // TODO remove files first?

        try {
            $this->environment->log('Executing static content deploy...');
            $this->environment->log(
                $this->runCommand(
                    $this->getStaticContentDeployArrayInput([Area::AREA_FRONTEND])
                )->fetch()
            );
            $this->environment->log(
                $this->runCommand(
                    $this->getStaticContentDeployArrayInput([Area::AREA_ADMINHTML])
                )->fetch()
            );
        } catch (Error $e) {
            $this->environment->getLogger()->error($e->getMessage());

            return;
        } catch (Exception $e) {
            $this->environment->getLogger()->error($e->getMessage());

            return;
        }

        try {
            $this->environment->log(sprintf('Moving compiled assets to %s', $this->environment->getStaticDir()));
            // TODO change?
            AssetMover::moveAssetDirectory(
                $this->environment->getProjectRoot() . $this->environment->getStaticDir(),
                $this->environment->getProjectRoot() . $this->environment->getStaticDirInit()
            );
            $this->environment->log('Done moving compiled assets');
        } catch (Error $e) {
            $this->environment->getLogger()->error($e->getMessage());
        } catch (Exception $e) {
            $this->environment->getLogger()->error($e->getMessage());
        }
    }


    /**
     * @param array $areas
     * @param array $themes
     * @param array $languages
     *
     * @return ArrayInput
     */
    protected function getStaticContentDeployArrayInput(
        array $areas = [],
        array $themes = [],
        array $languages = []
    ): ArrayInput {
        $parameters = [];
        $parameters['command'] = self::CMD_NAME_STATIC_CONTENT_DEPLOY;
        $parameters['--' . DeployStaticOptions::FORCE_RUN] = true;

        if (count($areas) > 0) {
            $parameters['--' . DeployStaticOptions::AREA] = $areas;
        }

        if (count($themes) > 0) {
            $parameters['--' . DeployStaticOptions::THEME] = $themes;
        }

        if (count($languages) > 0) {
            $parameters['--' . DeployStaticOptions::LANGUAGES_ARGUMENT] = $languages;
        }

        if (isset($this->environment->getConfig()['static-content']['jobs'])) {
            $parameters['--' . DeployStaticOptions::JOBS_AMOUNT] = $languages;
        }

        return new ArrayInput($parameters);
    }
}
