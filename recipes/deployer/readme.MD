#  Deploying with deployer
Deployer is a PHP deployment tool. See https://deployer.org/ for more info

## Deploying to Hypernode
1. Copy the following files to the root of your project
    - `recipes/deployer/deploy.php`
    - `recipes/deployer/.hypernode.hosts.yml`
2. Modify the following lines in .hypernode.hosts.yml to match your hypernode
    - change `domain.com` to the production domain of your application
    - change `hostname: nodename.hypernode.io` to match your hypernode
    - change `staging.domain.com` to your staging URL. Append with -8888 or -8443 if your staging is on the same node.
    - change `hostname: devnodename.hypernode.io` to match your staging hypernode.
3. You can now run deployer to build and deploy your application. to your hypernode. 
We recommend that you use a build server for this. For an example of running this deployer recipe with pipelines see `recipes/pipelines/readme.MD`

## Deploying to an already provisioned hypernode
TODO: add text on how to switch from manual deploy mode to this deployer recipe without loosing media and configuration data.

## Installing depoloyer on your system
This is only needed for testing / development purpose. 
To deploy with deployer we recommand to use a build server, for example: pipelines, capristrano

For linux:
```console
curl -LO https://deployer.org/deployer.phar
mv deployer.phar /usr/local/bin/dep
chmod +x /usr/local/bin/dep
```

