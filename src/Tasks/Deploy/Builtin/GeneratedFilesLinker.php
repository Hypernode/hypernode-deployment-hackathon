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
        if (file_exists($this->environment->getProjectRoot() . $target)) {
            try {
                if (file_exists($link)) {
                    //Moving files in stead of deleting because this is faster.
                    // Will do a cleanup when maintenance mode is disabled
                    rename($this->environment->getProjectRoot() . $link,
                    $this->environment->getProjectRoot() . $link . time() . '.old');
                }

                symlink($this->environment->getProjectRoot() . $target,
                    $this->environment->getProjectRoot() . $link);

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
