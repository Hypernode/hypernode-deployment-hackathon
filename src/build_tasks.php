<?php
/**
 * Register build tasks to Magento even when Magento is not installed yet.
 */
if (PHP_SAPI == 'cli') {
    /*\Hypernode\Deployment\Build\Task\BuildTaskList::registerTask(
        new \Hypernode\Deployment\Build\Task\Builtin\DeployStaticContent(100)
    );*/
}