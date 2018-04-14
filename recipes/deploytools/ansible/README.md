# Deploying with ansible

Ansible is a configuration management tool. See https://www.ansible.com/ for more info

## Deploying to Hypernode

The use case here is that you run ansible in your CI tool like as part of a jenkins job for example (or just from your laptop). Ansible will log in to the Hypernode and perform the work. It is not intended that you run ansible on the Hypernode itself. Hypernodes don't offer complete python tooling (virtualenv, etc) because it is not made to host python applications, so it is not trivial to install ansible on the deploy target. Instead, a remote server that has access to the deploy target orchestrating the work should run ansible.


