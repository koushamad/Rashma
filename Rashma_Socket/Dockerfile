FROM golang:1.12-alpine

RUN apk update && apk upgrade && apk add --no-cache bash git openssh

WORKDIR /application

COPY . .

RUN go get -d -v -t
RUN go build -o socketServer .

EXPOSE 1000

CMD ["./socketServer"]