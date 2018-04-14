<?php
/**
 * Register build tasks to Magento even when Magento is not installed yet.
 */

if (PHP_SAPI == 'cli') {
    \Hypernode\Deployment\Tasks\Build\BuildTaskList::registerTasks(
        new \Hypernode\Deployment\Tasks\Build\Builtin\SetupDiCompile(100)
    );
}