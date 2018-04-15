<?php

namespace Hypernode\Deployment\Assets;

use Exception;
use Magento\Framework\Filesystem\Driver\File;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

class AssetMover
{
    /**
     * @param string $source
     * @param string $target
     *
     * @return void
     *
     * @throws Exception
     */
    public static function moveAssetDirectory(string $source, string $target)
    {
        $fileSystem = new File();

        // (Re)create directory
        if ($fileSystem->isDirectory($target)) {
            $fileSystem->deleteDirectory($target);
        }

        $fileSystem->createDirectory($target);

        if ($fileSystem->isDirectory($target) !== true) {
            throw new Exception('Target path does not exist and could not be created');
        }

        // Iterate through files
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($iterator as $item) {
            if ($item->isDir()) {
                $fileSystem->createDirectory($target . $item->getSubPathName());
            } else {
                $fileSystem->rename($item, $target . $item->getSubPathName());
            }
        }
    }
}
