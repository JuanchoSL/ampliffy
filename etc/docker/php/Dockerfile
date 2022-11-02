FROM php:8.1-fpm

RUN docker-php-ext-install pdo_mysql

RUN apt-get update && apt-get install -y git zip nano zsh git iputils-ping

WORKDIR /application
COPY ./public ./public
COPY ./bin ./bin
COPY ./src ./src
COPY ./tests ./tests
COPY composer.json .

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer
RUN composer update 

RUN git config --global user.email \'JuanchoSL@hotmail.com\'
RUN git config --global user.name \'Juan Sánchez\'

COPY etc/docker/php/conf.d/php.ini /usr/local/etc/php/php.ini

COPY etc/docker/php/conf.d/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
RUN pecl install xdebug-3.1.1
#&& docker-php-ext-enable xdebug

#COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
#RUN apt-get update
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
