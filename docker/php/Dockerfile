FROM php:8.2-cli

RUN apt-get update && apt-get install -y curl ca-certificates openssl \
    && update-ca-certificates

WORKDIR /app
COPY . .