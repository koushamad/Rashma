FROM tvial/alpine-docker-comp

RUN apk update && apk upgrade && apk add --no-cache bash git openssh

WORKDIR /application

COPY . .

RUN docker-compose up -d --build