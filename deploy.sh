#!/bin/bash

echo Please select your deployment state? local, test, live
read state

if [ $state == "live" ]; then
  echo Please select your deployment state? up, down, build
  read state

  if [ $state == "build" ]; then
    git commit -a -m "deploy"
    git push

    docker rm -f $(docker ps -aq)
    docker volume rm $(docker volume ls -q)
    docker rmi -f koushamad/rashma-php-fpm
    docker rmi -f koushamad/rashma_file-server
    docker rmi -f koushamad/rashma-socket-server
    docker rmi -f koushamad/rashma-git-server

    docker-compose up -d --build

    docker push koushamad/rashma-php-fpm:latest
    docker push koushamad/rashma-file-server:latest
    docker push koushamad/rashma-socket-server:latest
    docker push koushamad/rashma-git-server:latest

    docker-compose config > docker-compose-deploy.yaml && kompose convert -f docker-compose-deploy.yaml --out ./Rashma_Docker/k8s
    docker-compose down
    rm -rvf docker-compose-deploy.yaml
  fi

  if [ $state == "up" ]; then
    kubectl create -f ./Rashma_Docker/k8s --save-config
  fi

  if [ $state == "down" ]; then
    kubectl delete -f ./Rashma_Docker/k8s
  fi
fi

if [ $state == "test" ]; then
  docker-compose down
  docker-compose up -d
fi

if [ $state == "local" ]; then
  docker-compose up --build  --remove-orphans
fi



