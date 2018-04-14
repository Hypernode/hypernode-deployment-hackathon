<?php

namespace Hypernode\Deployment\Assets;

use Hypernode\Deployment;

class AssetMover
{

    /**
     * @param string $path
     *
     * @return void
     * @throws \Exception
     */
    public static function moveAssetDirectory(string $path)
    {
        $basePath = Deployment\Environment::$MAGENTO_ROOT;
        $sourcePath = $basePath . DIRECTORY_SEPARATOR . $path;
        $targetPath = $basePath . DIRECTORY_SEPARATOR . '.init' . DIRECTORY_SEPARATOR . $path;

        // Create directory
        mkdir($targetPath, 0777, true);

        if (is_dir($targetPath) !== true) {
            throw new \Exception('Target path does not exist and could not be created');
        }

        // Iterate through files
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($sourcePath, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($iterator as $item) {
            if ($item->isDir()) {
                mkdir($targetPath . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
            } else {
                copy($item, $targetPath . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
            }
        }
    }

}