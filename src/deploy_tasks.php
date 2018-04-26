<?php
/**
 * Register build tasks to Magento even when Magento is not installed yet.
 */

use Hypernode\Deployment\Tasks\Deploy\Builtin\DisableMaintenance;
use Hypernode\Deployment\Tasks\Deploy\Builtin\EnableMaintenance;
use Hypernode\Deployment\Tasks\Deploy\Builtin\SetupStaticContentDeploy;
use Hypernode\Deployment\Tasks\Deploy\Builtin\GeneratedFilesLinker;
use Hypernode\Deployment\Tasks\Deploy\Builtin\SetupUpgrade;
use Hypernode\Deployment\Tasks\Deploy\DeployTaskList;

if (PHP_SAPI == 'cli') {
    DeployTaskList::registerTasks(
        new EnableMaintenance(0),
        new GeneratedFilesLinker(100),
        new SetupUpgrade(200),
        new SetupStaticContentDeploy(300),
        new DisableMaintenance(9000)
    );
}
