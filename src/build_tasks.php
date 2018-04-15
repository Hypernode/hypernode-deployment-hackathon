<?php
/**
 * Register build tasks to Magento even when Magento is not installed yet.
 */

use Hypernode\Deployment\Tasks\Build\BuildTaskList;
use Hypernode\Deployment\Tasks\Build\Builtin\SetupDiCompile;
use Hypernode\Deployment\Tasks\Build\Builtin\SetupStaticContentDeploy;

if (PHP_SAPI == 'cli') {
    BuildTaskList::registerTasks(
        new SetupDiCompile(100),
        new SetupStaticContentDeploy(200)
    );
}
