<?php
/**
 * Register CLI commands to Magento even when Magento is not installed yet.
 */

use Hypernode\Deployment\Console\CommandList;
use Magento\Framework\Console\CommandLocator;

if (PHP_SAPI == 'cli') {
    CommandLocator::register(CommandList::class);
}
