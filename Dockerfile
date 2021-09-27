# Composer dependencies
FROM composer:2 as vendor
COPY api/composer.json composer.json
COPY api/composer.lock composer.lock
# COPY custom-plugins/ ../custom-plugins/
RUN composer install --ignore-platform-reqs --no-interaction --prefer-dist

FROM gcr.io/skyviewer/craft-base-image:test

LABEL maintainer="erosas@lsst.org"

USER root
# Copy in custom code from the host machine.
WORKDIR /var/www/html
COPY --chown=www-data:www-data api/ ./
COPY --from=vendor --chown=www-data:www-data /app/vendor /var/www/html/vendor
RUN [ -d /var/www/html/storage ] || mkdir /var/www/html/storage

USER www-data

ENTRYPOINT ["/docker-entrypoint.sh"]

CMD [ "/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf" ]
