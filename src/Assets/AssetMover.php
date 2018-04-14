<?php

namespace Hypernode\Deployment\Assets;

use Exception;
use Hypernode\Deployment\Environment;
use Magento\Framework\Filesystem\Driver\File;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

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
        $fileSytem  = new File();
        $basePath   = Environment::$MAGENTO_ROOT;
        $sourcePath = $basePath . DIRECTORY_SEPARATOR . $path;
        $targetPath = $basePath . DIRECTORY_SEPARATOR . '.init' . DIRECTORY_SEPARATOR . $path;

        // (Re)create directory
        if ($fileSytem->isDirectory($targetPath)) {
            $fileSytem->deleteDirectory($targetPath);
        }
        $fileSytem->createDirectory($targetPath);

        if ($fileSytem->isDirectory($targetPath) !== true) {
            throw new Exception('Target path does not exist and could not be created');
        }

        // Iterate through files
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($sourcePath, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($iterator as $item) {
            if ($item->isDir()) {
                $fileSytem->createDirectory($targetPath . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
            } else {
                $fileSytem->rename($item, $targetPath . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
            }
        }
    }
}