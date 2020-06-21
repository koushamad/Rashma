FROM golang:1.12-alpine

RUN apk update && apk upgrade && apk add --no-cache bash git openssh

WORKDIR /application

#COPY . .

WORKDIR /application/src

RUN go get -d -v -t
RUN go build -o fileServer .

EXPOSE 8080

CMD ["./fileServer"]