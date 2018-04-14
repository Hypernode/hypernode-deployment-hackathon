# Run the default build first
./build.sh

# Now tag it to get pushed
docker build . -t tdgroot/hypernode-build-docker:latest
docker build . -f Dockerfile-70 -t tdgroot/hypernode-build-docker:php70
docker build . -f Dockerfile-71 -t tdgroot/hypernode-build-docker:php71

# Push the images
docker push tdgroot/hypernode-build-docker:latest
docker push tdgroot/hypernode-build-docker:php70
docker push tdgroot/hypernode-build-docker:php71
