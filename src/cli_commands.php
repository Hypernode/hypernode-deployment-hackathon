<?php
/**
 * Register CLI commands to Magento even when Magento is not installed yet.
 */
if (PHP_SAPI == 'cli') {
    \Magento\Framework\Console\CommandLocator::register(\Hypernode\Deployment\Console\CommandList::class);
}