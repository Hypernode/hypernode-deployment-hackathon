#!/bin/bash

BASEDIR=$(dirname "$0")

ansible-playbook $BASEDIR/deploy.yml  -i $BASEDIR/hosts  --extra-vars "pwd=$(pwd)" $*
