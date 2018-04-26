<?php

namespace Hypernode\Deployment\Tasks\Deploy\Builtin;

use Exception;
use Hypernode\Deployment;
use Symfony\Component\Console\Input\ArrayInput;

class GeneratedFilesLinker extends Deployment\Tasks\Task\AbstractTask
{

    /**
     * Symlink generated files that where created during build.
     * 
     * @return void
     */
    public function run()
    {
        $this->environment->log('Start linking of generated files from build artifact to Magento directories...');

        //Symlink generated code
        $this->symlink($this->environment->getGeneratedCodeDirInit(), $this->environment->getGeneratedCodeDir());

        //Symlink metadata
        $this->symlink($this->environment->getGeneratedMetadataDirInit(), $this->environment->getGeneratedMetadataDir());

        //Symlink static content
        $this->symlink($this->environment->getStaticDirInit(), $this->environment->getStaticDir());
    }

    /**
     * Try to symlink directories
     *
     * @param string $target
     * @param string $link
     */
    protected function symlink($target, $link)
    {
        $target = rtrim($target, '/');
        $link = rtrim($link, '/');

        if (file_exists($this->environment->getProjectRoot() . $target)) {
            try {
                var_dump(sprintf('ln -sfn %s %s',
                    $this->environment->getProjectRoot() . $target,
                    $this->environment->getProjectRoot() . $link));
                exec(sprintf('rm -rf %s && ln -sfn %s %s',
                    $this->environment->getProjectRoot() . $link,
                    $this->environment->getProjectRoot() . $target,
                    $this->environment->getProjectRoot() . $link));

                $this->environment->log(sprintf('Syminked %s to %s', $target, $link));
            } catch (\Exception $e) {
                $this->environment->getLogger()->error(sprintf('Error symlinking %s', $target));
                $this->environment->getLogger()->error($e->getMessage());
            }
        } else {
            $this->environment->getLogger()->error(sprintf('There was no %s found in artifact', $target));
        }
    }

}
