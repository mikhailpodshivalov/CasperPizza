#!/bin/bash

cd /var/www

if [ ! -f ".env" ]; then
    cp .env.example .env
fi
composer install
chmod 775 -R storage/
php artisan key:generate
php artisan optimize

php-fpm
