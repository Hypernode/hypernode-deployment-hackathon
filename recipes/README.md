# Recipes

This directory contains recipes for various deploytools and jobrunners with examples of how to orchestrate a complete deploy for a Magento 2 shop using the Magento module in the `src` directory of this repository.

The jobrunner subdirectory contains recipes for CI-like tools, this is the part that runs the deploytool. Various deploytools recipes can be found in the deploytools directory. For example, Bitbucket Pipelines can be used to run Deployer. But for example, Bitbucket Pipelines can also run ansible. Or perhaps you don't want to use Pipelines at all and run everything from Jenkins or perhaps even from your laptop. The idea is to keep everything modular and not make any assumptions of what tools are used, so this directory contains configurations for multiple tools to implement the same general steps.

