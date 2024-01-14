FROM php:8.1-cli

RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash
RUN apt-get update -y && apt-get install -y libmcrypt-dev symfony-cli npm nodejs

RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install mysqli

WORKDIR /app
COPY . /app

RUN symfony composer install && npm i && npm run build

#RUN crontab -l | { cat; echo "*/1 * * * * bash symfony app:request-exchange-currency-data"; } | crontab -

EXPOSE 8000
CMD symfony server:start