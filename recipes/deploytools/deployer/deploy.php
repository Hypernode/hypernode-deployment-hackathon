<?php

namespace Deployer;

require_once 'recipe/common.php';

// Configuration
//Shared files are files that will be shared between each build
set('shared_files', [
    'app/etc/env.php',
    'var/.maintenance.ip',
]);

//Shared dirs are directories that will be shared between each build. Please dont share  the whole var dir.
set('shared_dirs', [
    'var/log',
    'var/backups',
    'pub/media',
]);

//Writeable dirs are dirs that will be made writeable
set('writable_dirs', [
    'var',
    'pub/static',
    'pub/media',
]);

//clear_paths will be cleared after deploying
set('clear_paths', [
    'var/cache/*',
]);

//Basic hypernode configuration settings for deployer
set('writable_mode', 'chmod');
set('writable_use_sudo', false);
set('public_folder_production', '~/public');
set('public_folder_staging', '~/staging');

//Composer installation parameters in deploy:vendors command (`{{bin/composer}} {{composer_options}}`)
set('composer_action', 'install');
set('composer_options', '{{composer_action}} --verbose --prefer-dist --no-progress --no-interaction --no-dev --optimize-autoloader');

//Load the host information from .hypernode.hosts.yaml
inventory('.hypernode.hosts.yaml');

// Tasks
//TESTS
task('tests:run', function () {
    //Todo: implement your test routine here
})->local();

//BUILD
task('build', function () {
    set('deploy_path', __DIR__);
    set('release_path', __DIR__);
    set('public_dir', '/');

    invoke('deploy:vendors');
    invoke('build:magento');
})->local();

task('build:magento', function () {
    run("{{bin/php}} {{release_path}}/bin/magento hypernode:build");
});

//DEPLOY
task('deploy:magento', function () {
    run("{{bin/php}} {{release_path}}/bin/magento hypernode:deploy");
});

//UPLOAD
task('upload', function () {
    upload(__DIR__.'/', '{{release_path}}');
});

//SYMLINK
task('symlink:hypernode', function () {
    $stage = get('stage');
    $public_folder = get('public_folder_'.$stage);
    if (!$public_folder) throw new Exception(sprintf("Public folder not found for stage: %s", $stage));

    set('public_folder', $public_folder);
    run("{{bin/symlink}} -f {{deploy_path}}/current/pub {{public_folder}}");
});

//HOOKS
after('deploy:symlink', 'symlink:hypernode');

//DEPLOY
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:release',
    'build',
    'upload',
    'deploy:shared',
    'deploy:writable',
    'deploy:symlink',
    'deploy:magento',
    'cleanup',
    'success'
]);