FROM alpine:latest

RUN apk update && apk upgrade && apk add --no-cache bash git openssh
RUN apk update && apk add docker make py-pip && pip install docker-compose

WORKDIR /application

COPY . .

RUN docker-compose up -d --build