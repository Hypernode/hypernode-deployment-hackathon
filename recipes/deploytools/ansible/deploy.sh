#!/bin/bash

BASEDIR=$(dirname "$0")
export ANSIBLE_COW_SELECTION=tux
ansible-playbook $BASEDIR/deploy.yml  -i $BASEDIR/hosts  --extra-vars "pwd=$(pwd)" --extra-vars "@$BASEDIR/config.yml" $*
