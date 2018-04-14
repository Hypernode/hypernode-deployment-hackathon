# hypernode-build-docker
A simple docker image for building Magento 2 artifacts, with Hypernode software.

## Building
Run the following:

`./build.sh`

Run the Ansible playbook to make sure everything is running nicely:

`ansible-playbook playbook-build-and-test.yml`

## Usage
After building, run the following to spin up  a container:

`docker run -d -v /path/to/your/magento2/project:/data/web/magento2 --name magento2-instance hypernode-build-docker:latest mysqld -uroot`

## TODO
- Running redis instance
