FROM phpswoole/swoole:5.0-php8.2

ARG USER=swoole
ARG UID=1000

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions pdo_pgsql

RUN useradd --create-home --shell /bin/bash -U $USER -u $UID

USER $USER
