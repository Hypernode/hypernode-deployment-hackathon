<?php
/**
 * Register build tasks to Magento even when Magento is not installed yet.
 */

if (PHP_SAPI == 'cli') {
    \Hypernode\Deployment\Tasks\Build\BuildTaskList::registerTasks(
        new \Hypernode\Deployment\Tasks\Build\Builtin\SetupDiCompile(100),
        new \Hypernode\Deployment\Tasks\Build\Builtin\Test20(20),
        new \Hypernode\Deployment\Tasks\Build\Builtin\Test30(30),
        new \Hypernode\Deployment\Tasks\Build\Builtin\Test40(40),
        new \Hypernode\Deployment\Tasks\Build\Builtin\Test50(50)
    );
}