FROM alpine:3.18.3

LABEL MAINTAINER="Tureanu Vlad svlad.tureanu@gmail.com"

ENV PHP_CONF /etc/php81/php.ini
ENV PHP_CONFD /etc/php81/php-fpm.d
ENV FPM_CONF /etc/php81/php-fpm.conf
ENV WWW_FPM_CONF /etc/php81/php-fpm.d/www.conf

# add custom php-fpm pool settings, these get written at entrypoint startup
ENV FPM_PM_MAX_CHILDREN=256 \
    FPM_PM_START_SERVERS=3 \
    FPM_PM_MIN_SPARE_SERVERS=2 \
    FPM_PM_MAX_SPARE_SERVERS=4 \
    FPM_PM_MAX_REQUESTS=200 \
    FPM_OWNER="nginx" \
    FPM_LISTEN="/var/run/php/php8.1-fpm.sock"

# add custom php-fpm pool settings, these get written at entrypoint startup
ENV PHP_MEMORY_LIMIT_MB=256 \
    PHP_UPLOAD_MAX_FILESIZE_MB=100 \
    PHP_POST_MAX_SIZE_MB=100

RUN mkdir -p /var/www
# Building process
COPY . /var/www

WORKDIR /var/www/

# Essentials
RUN echo "UTC" > /etc/timezone
RUN apk add --no-cache zip unzip curl sqlite nginx supervisor

# Installing bash
RUN apk add bash net-tools
RUN sed -i 's/bin\/ash/bin\/bash/g' /etc/passwd

# Installing composer
# Latest release
COPY --from=composer/composer:latest-bin /composer /usr/local/bin

# Install PHP extensions dependies
RUN apk add --update bzip2-dev

RUN apk add --no-cache --update nano
RUN apk add --no-cache --update zip
RUN apk add --no-cache --update unzip
# Install python/pip
RUN apk add --update --no-cache python3 && ln -sf python3 /usr/bin/python
RUN python3 -m ensurepip
RUN pip3 install --no-cache --upgrade pip setuptools
RUN apk add --no-cache --update git

RUN echo "https://dl-cdn.alpinelinux.org/alpine/edge/testing/" >> /etc/apk/repositories

RUN apk update
RUN apk add --update php81
RUN apk add --no-cache --update php81-common
RUN apk add --no-cache --update php81-fpm
RUN apk add --no-cache --update php81-pdo
RUN apk add --no-cache --update php81-opcache
RUN apk add --no-cache --update php81-zip
RUN apk add --no-cache --update php81-phar
RUN apk add --no-cache --update php81-iconv
RUN apk add --no-cache --update php81-cli
RUN apk add --no-cache --update php81-curl
RUN apk add --no-cache --update php81-openssl
RUN apk add --no-cache --update php81-mbstring
RUN apk add --no-cache --update php81-tokenizer
RUN apk add --no-cache --update php81-fileinfo
RUN apk add --no-cache --update php81-json
RUN apk add --no-cache --update php81-xml
RUN apk add --no-cache --update php81-xmlwriter
RUN apk add --no-cache --update php81-simplexml
RUN apk add --no-cache --update php81-dom
RUN apk add --no-cache --update php81-pdo_mysql
RUN apk add --no-cache --update php81-pdo_sqlite
RUN apk add --no-cache --update php81-tokenizer
RUN apk add --no-cache --update php81-pecl-redis
RUN apk add --no-cache --update php81-bcmath
RUN apk add --no-cache --update php81-dev
RUN apk add --no-cache --update php81-mbstring
RUN apk add --no-cache --update php81-mbstring
RUN apk add --no-cache --update php81-curl
RUN apk add --no-cache --update php81-gd
# php81.0-imagick missing
RUN apk add --no-cache --update php81-pgsql
RUN apk add --no-cache --update php81-intl
RUN apk add --no-cache --update php81-pear
RUN apk add --no-cache --update php81-pcntl
RUN apk add --no-cache --update php81-posix
RUN apk add --no-cache --update librdkafka


# Configure php
#RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
RUN sed -i -e "s/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/g" ${PHP_CONF} \
    && sed -i -e "s/memory_limit\s*=\s*.*/memory_limit = ${PHP_MEMORY_LIMIT_MB}M/g" ${PHP_CONF} \
    && sed -i -e "s/upload_max_filesize\s*=\s*2M/upload_max_filesize = ${PHP_UPLOAD_MAX_FILESIZE_MB}M/g" ${PHP_CONF} \
    && sed -i -e "s/post_max_size\s*=\s*8M/post_max_size = ${PHP_POST_MAX_SIZE_MB}M/g" ${PHP_CONF} \
    && sed -i -e "s/variables_order = \"GPCS\"/variables_order = \"EGPCS\"/g" ${PHP_CONF}

## Configure fpm
 RUN sed -i -e "s/;daemonize\s*=\s*yes/daemonize = no/g" ${FPM_CONF}



## Configure [www] fpm
RUN sed -i -e "s/;catch_workers_output\s*=\s*yes/catch_workers_output = yes/g" ${WWW_FPM_CONF} \
    && sed -i -e "s/pm.max_children = 5/pm.max_children = ${FPM_PM_MAX_CHILDREN}/g" ${WWW_FPM_CONF} \
    && sed -i -e "s/pm.start_servers = 2/pm.start_servers = ${FPM_PM_START_SERVERS}/g" ${WWW_FPM_CONF} \
    && sed -i -e "s/pm.min_spare_servers = 1/pm.min_spare_servers = ${FPM_PM_MIN_SPARE_SERVERS}/g" ${WWW_FPM_CONF} \
    && sed -i -e "s/pm.max_spare_servers = 3/pm.max_spare_servers = ${FPM_PM_MAX_SPARE_SERVERS}/g" ${WWW_FPM_CONF} \
    && sed -i -e "s/pm.max_requests = 500/pm.max_requests = $FPM_PM_MAX_REQUESTS}/g" ${WWW_FPM_CONF} \
    && sed -i -e "s/nobody/${FPM_OWNER}/g" ${WWW_FPM_CONF} \
    && sed -i -e "s|listen = 127.0.0.1:9000|listen = ${FPM_LISTEN}|g" ${WWW_FPM_CONF} \
    && sed -i -e "s|;listen.owner = nginx|listen.owner = ${FPM_OWNER}|g" ${WWW_FPM_CONF} \
    && sed -i -e "s|;listen.group = nginx|listen.group = ${FPM_OWNER}|g" ${WWW_FPM_CONF} \
    && sed -i -e "s|;listen.mode = 0660|listen.mode = 0660|g" ${WWW_FPM_CONF} \
    && sed -i -e "s/^;clear_env = no$/clear_env = no/" ${WWW_FPM_CONF} \
    && sed -i -e "s|;prefix = /path/to/pools/\$pool|;prefix = /var/run/php|g" ${WWW_FPM_CONF}


# Configure supervisor
RUN mkdir -p /etc/supervisor.d/
COPY ./.docker/supervisord/supervisord.conf /etc/supervisor.d/supervisord.conf

# Configure PHP
RUN mkdir -p /run/php/
RUN touch /run/php/php8.1-fpm.pid

# Configure nginx
COPY ./.docker/nginx/default.conf /etc/nginx/nginx.conf

# Enable opcache
COPY .docker/php/conf.d/opcache.ini ${PHP_CONFD}/opcache.ini

RUN mkdir -p /run/nginx/
RUN touch /run/nginx/nginx.pid
RUN ln -sf /usr/bin/php81 /usr/bin/php
RUN ln -sf /dev/stdout /var/log/nginx/access.log
RUN ln -sf /dev/stderr /var/log/nginx/error.log



# Checks if environment is set to production to install dependencies at build time
# otherwise you need to install them manually
ARG ENV=dev
ENV ENV=$ENV
RUN if [ "$ENV" = "prod" ] ; then composer install --no-dev; else echo "Not in prod mode"; fi
RUN chown -R nginx:nginx /var/www/storage


EXPOSE 80
CMD ["supervisord", "-c", "/etc/supervisor.d/supervisord.conf"]
