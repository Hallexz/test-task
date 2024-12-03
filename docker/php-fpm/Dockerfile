FROM php:8.2-fpm-alpine

# Установка необходимых пакетов
RUN apk add --no-cache --update \
    $PHPIZE_DEPS \
    shadow \
    icu-dev \
    libzip-dev

# Конфигурирование и установка PHP расширений
RUN docker-php-ext-configure pdo_mysql --with-pdo-mysql && docker-php-ext-configure intl --enable-intl
RUN docker-php-ext-install -j$(nproc) pdo_mysql intl zip opcache

# Настройка PHP
RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

# Установка Composer
COPY --from=composer:2.1 /usr/bin/composer /usr/local/bin/composer

# Проверка и создание пользователя www-data
RUN id -u www-data || adduser -D -g www-data -u 1000 www-data

# Установка рабочего каталога
WORKDIR /var/www/test-task

# Переключение на пользователя
USER www-data
