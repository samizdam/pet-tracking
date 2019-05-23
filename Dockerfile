FROM php:7.3.5-cli-stretch

RUN curl https://raw.githubusercontent.com/composer/getcomposer.org/76a7060ccb93902cd7576b67264ad91c8a2700e2/web/installer | php -- --quiet \
    && mv composer.phar /usr/bin/composer

CMD php -S 0.0.0.0:9000 -t public/
