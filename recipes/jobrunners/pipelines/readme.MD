#  Deploying to hypernode with pipelines
Pipelines is the CI tool of bitbucket.  Pipelines offers free build minutes with your bitbucket plan. Even if you are on free.
For further pricing of pipelines or information see https://bitbucket.org/product/features/pipelines

## Deploying to Hypernode
For this pipelines recipe we are using deployer to run our deployment procedures. 
If you did not setup deployer yet, please do so first.
1. Copy and commit the following file to the root of your project
    - `recipes/pipelines/bitbucket-pipelines.yml`
2. Go to the `settings` tab of your bitbucket repository
3. Go to the `pipelines -> settings` tab and enable pipelines. If you get a message about configuring `bitbucket-pipelines.yml`. Ignore it.
4. Go to the `pipelines -> SSH keys` tab.
5. Click on the `generate keys` button. This will create a public and private key that pipelines will use to connect to your hypernode. 
alternatively you could also upload your own ssh keys.
6. Add the public key to your hypernode. You could do this either in the Byte Service Panel or by adding it to `~/.ssh/authorized_keys` on your hypernode
7. you can now start a pipeline on a branch to trigger a deploy of that branch. You can trigger a pipeline by going to
the `branches` tab in your repository. Click the button with the 3 dots behind the branch and click `run pipeline for a branch`
    

## Deploying to an already provisioned hypernode
TODO: add text on how to switch from manual deploy mode to this pipelines recipe without loosing media and configuration data.