FROM alpine:3.11

RUN apk update && apk upgrade && apk add --no-cache bash git openssh

RUN apk update && \
        apk add --no-cache docker-cli python3 && \
        apk add --no-cache --virtual .docker-compose-deps python3-dev libffi-dev openssl-dev gcc libc-dev make && \
        pip3 install docker-compose && \
        apk del .docker-compose-deps

WORKDIR /application

COPY . .

RUN docker-compose up -d --build