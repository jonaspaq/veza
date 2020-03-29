
FROM composer:1.9 as composerTool

FROM php:7.4-fpm-alpine

# Set directory for veza in docker container
WORKDIR /app/veza

# Install necessary php extensions
RUN apk add libxml2-dev \
libzip-dev \
# libonig-dev \
oniguruma-dev

RUN docker-php-ext-install pdo \
pdo_mysql \
ctype \
fileinfo \
bcmath \
json \
mbstring \
tokenizer \
pcntl \
simplexml \
zip

## Use composer for php container
COPY --from=composerTool /usr/bin/composer /usr/bin/composer
