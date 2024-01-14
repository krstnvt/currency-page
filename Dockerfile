FROM php:8.1-cli

RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash
RUN apt-get update -y && apt-get install -y libmcrypt-dev symfony-cli npm nodejs

RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /app
COPY . /app

RUN symfony composer install && npm i && npm run dev

EXPOSE 8000
CMD symfony server:start