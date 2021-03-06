FROM alpine:3.13

# Install packages and remove default server definition
RUN apk --no-cache add php7 php7-fpm php7-opcache php7-pgsql php7-pdo_pgsql php7-json php7-openssl php7-pdo php7-xml php7-curl \
    php7-zlib php7-xml php7-phar php7-intl php7-dom php7-xmlreader php7-ctype php7-simplexml php7-session \
    php7-mbstring php7-gd php7-redis php7-zip php7-fileinfo php7-tokenizer php7-xmlwriter \
    nginx supervisor curl git && \
    rm /etc/nginx/conf.d/default.conf

# Make sure files/folders needed by the processes are accessable when they run under the nobody user
RUN chown -R nobody.nobody /run && \
  chown -R nobody.nobody /var/lib/nginx && \
  chown -R nobody.nobody /var/log/nginx && \
  mkdir /app && chown -R nobody.nobody /app && \
  mkdir /.composer && chown -R nobody.nobody /.composer

# Switch to use a non-root user from here on
USER nobody

WORKDIR /app

COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY --chown=nobody composer.* ./
RUN composer install --no-progress --no-autoloader --no-scripts -q

# Add application
COPY --chown=nobody . .
RUN rm -rf ./.gitlab && rm -rf ./.git
RUN composer install --no-progress -q -o
RUN composer run post-root-package-install

# Expose the port nginx is reachable on
EXPOSE 5000

ARG APP_ENV="local"
ARG APP_DEBUG="true"
ARG DB_CONNECTION="mysql"

ENV APP_ENV ${APP_ENV}
ENV APP_DEBUG ${APP_DEBUG}
ENV DB_CONNECTION ${DB_CONNECTION}
ENV APP_SECURE "true"

USER root
# Configure nginx
COPY .gitlab/config/nginx.conf /etc/nginx/nginx.conf

# Configure PHP-FPM
COPY .gitlab/config/fpm-pool.conf /etc/php7/php-fpm.d/www.conf
COPY .gitlab/config/php.ini /etc/php7/conf.d/custom.ini

# Configue cron
COPY .gitlab/config/cron /etc/crontabs/application

# Configure supervisord
COPY .gitlab/config/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

USER nobody
# Let supervisord start nginx & php-fpm
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
