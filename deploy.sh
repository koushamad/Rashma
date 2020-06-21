#!/bin/bash

echo Please select your deployment state? local, test, live
read state

if [ $state == "live" ]; then
  echo Start to deploy

  git commit -a -m "deploy"
  git push
fi

if [ $state == "test" ]; then
  docker-compose down
  docker-compose up -d
fi

if [ $state == "local" ]; then
  docker-compose up --build  --remove-orphans
fi



