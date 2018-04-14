<?php
/**
 * Register build tasks to Magento even when Magento is not installed yet.
 */

use \Hypernode\Deployment\Tasks\Deploy\Builtin\SetupUpgrade;

if (PHP_SAPI == 'cli') {
    \Hypernode\Deployment\Tasks\Deploy\DeployTaskList::registerTasks(
        new SetupUpgrade(100)
    );
}
