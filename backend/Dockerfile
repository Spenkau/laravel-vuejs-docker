FROM php:8.2-fpm-alpine

WORKDIR /var/www/laravel

RUN docker-php-ext-install pdo pdo_mysql

# Установка Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Копирование приложения Laravel и установка зависимостей
COPY . /var/www/laravel
RUN composer install

# Запуск Laravel и вебсокетов
CMD php artisan serve --host=0.0.0.0 --port=8000 & php artisan websockets:serve
