FROM php:7.1.5-fpm-alpine

RUN NPROC=$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) && \
    docker-php-ext-install -j$NPROC pdo pdo_mysql

EXPOSE 9000
