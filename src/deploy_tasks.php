<?php
/**
 * Register build tasks to Magento even when Magento is not installed yet.
 */

if (PHP_SAPI == 'cli') {
    \Hypernode\Deployment\Tasks\Deploy\DeployTaskList::registerTask(
        new \Hypernode\Deployment\Tasks\Deploy\Builtin\SetupUpgrade(100)
    );
}
