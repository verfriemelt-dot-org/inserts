FROM php:8.2-fpm

ARG USER
ARG UID=1000

RUN useradd -U $USER -u $UID

ENV TZ=Europe/Berlin
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions opcache pdo_pgsql


WORKDIR /var/www

EXPOSE 9000
USER $USER
CMD php-fpm
