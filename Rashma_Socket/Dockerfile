FROM golang:1.12-alpine

RUN apk update && apk upgrade && apk add --no-cache bash git openssh

WORKDIR /app

COPY . .

WORKDIR /app

RUN go get -d -v -t
RUN go build -o socketServer .

EXPOSE 9000

CMD ["./socketServer"]