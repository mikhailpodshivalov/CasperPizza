FROM php:8.2-fpm

# Установить системные зависимости
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Установить Xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug

# Настройки Xdebug
COPY ./build/php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Установить Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Установить рабочую директорию
WORKDIR /var/www/html

# Установить права доступа
RUN chown -R www-data:www-data /var/www/html

CMD ["php-fpm"]
