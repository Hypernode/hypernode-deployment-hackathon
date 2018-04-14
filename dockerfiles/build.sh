docker build . -t hypernode-build-docker:latest
docker build . -f Dockerfile-70 -t hypernode-build-docker:php70
docker build . -f Dockerfile-71 -t hypernode-build-docker:php71
