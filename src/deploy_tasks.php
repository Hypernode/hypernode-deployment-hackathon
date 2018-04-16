<?php
/**
 * Register build tasks to Magento even when Magento is not installed yet.
 */

use \Hypernode\Deployment\Tasks\Deploy\Builtin\SetupUpgrade;
use Hypernode\Deployment\Tasks\Deploy\DeployTaskList;

if (PHP_SAPI == 'cli') {
    DeployTaskList::registerTasks(
        new SetupUpgrade(100)
    );
}
