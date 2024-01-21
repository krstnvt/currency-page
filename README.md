# Author

Kristina Safonova


# Overview

**Assignment**:
Create a PHP back-end service that captures historical currency exchange rates on a daily basis and presents them in a front-end interface.

• Currency changes are imported using API service - https://anyapi.io/

• Data are be stored in SQL based database

• Data are refreshed with the most recent EUR to GBP, USD, AUD exchange
rates on daily basis

• Front-end interface allows user to select target currency and output it


## Tech stack and environment


**IDE:** PhpStorm 2023.1

**Back-end:** PHP 8.1, Symfony 6.2

**Front-end:** React, TypeScript 5.3.3

**Other:** Github, Docker


## Prerequisites

docker, docker-compose


## Setting up

1. Clone git repository - https://github.com/krstnvt/currency-page.git
2. Build and run docker project using _'docker-compose up -d --build'_ command
3. To start migration you need to run _'symfony console doctrine:migrations:migrate'_ command (e.g. to run migrations in the container, run _'docker exec [container id/name] symfony console doctrine:migrations:migrate'_)
5. To get the currency exchange data manually, you need to run _'symfony console app:request-exchange-currency-data'_ command (e.g. to run this command in the container, run _'docker exec [container id/name] symfony console app:request-exchange-currency-data'_ (this command is called automatically every day at midnight)


## Testing

To start tests, you need to run a 'php bin/phpunit **TestClass**' command, where **TestClass** is path to your test class


## Things to consider
**Local Web Server Symfony**

In my project I use Symfony Local Web Server, which is not allowed for use in a production environment, but for a home project Symfony Local Web Server will be enough. However, for a real project it would be appropriate to configure nginx in docker, which will solve the problem with using Symfony Local Web Server.

**Exchange Data**

Since the command for receiving currency exchange from the API is automatically launched only once a day, when raising the project, you could manually run the command to obtain the data, otherwise there will be no data on the front-end
