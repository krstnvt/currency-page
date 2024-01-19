FROM php:8.1-cli

RUN echo "deb http://ftp.us.debian.org/debian/ bookworm main" > /etc/apt/sources.list

RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash
RUN apt-get update -y
RUN apt-get install -y libmcrypt-dev symfony-cli npm nodejs

RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install mysqli

ENV DATABASE_URL mysql://kristina:trodo@database:3306/trodo_test
ENV PORT 8000
ENV MESSENGER_TRANSPORT_DSN doctrine://default?auto_setup=0
ENV CURRENCY_API_URL https://anyapi.io/api/v1/exchange/rates?apiKey=f427gq454ggqrklcpp00gn9ajt2ucst8q9bmfnba3dopn3aeis9ih8
ENV APP_ENV dev
ENV APP_SECRET a98cb399f3b6527d780dfb19b7a8fb1b

WORKDIR /app
COPY . /app

RUN symfony composer install
RUN npm i
RUN npm run build

EXPOSE 8000
CMD symfony server:start