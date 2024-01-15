FROM php:8.1-cli

RUN echo "deb http://ftp.us.debian.org/debian/ bookworm main" > /etc/apt/sources.list

RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash
RUN apt-get update -y && apt-get install -y libmcrypt-dev symfony-cli npm nodejs cron

RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install mysqli

WORKDIR /app
COPY . /app

RUN symfony composer install && npm i && npm run build

#RUN crontab -l | { cat; echo "*/1 * * * * bash symfony app:request-exchange-currency-data"; } | crontab -
#RUN echo "*/1 * * * * cd /app && bash symfony console app:request-exchange-currency-data >> /var/log/cron.log 2>&1" | crontab -
RUN chmod +x /app/curUpdate.sh

EXPOSE 8000
CMD symfony server:start