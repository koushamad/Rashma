FROM alpine:3.12

RUN apk update && apk upgrade && apk add --no-cache bash git openssh

WORKDIR /application