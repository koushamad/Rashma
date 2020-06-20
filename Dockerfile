FROM tvial/alpine-docker-compose

RUN apk update && apk upgrade && apk add --no-cache bash git openssh

WORKDIR /application

COPY . .

RUN docker-compose up -d --build