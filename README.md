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


## Setting up

1. Clone git repository - https://github.com/krstnvt/currency-page.git
2. Build and run docker project using _'docker-compose up -d --build'_ command
3. Run initial migration using _'docker exec **XX** symfony console doctrine:migrations:migrate'_, where **'XX'** is the first 2 signs of the symfony container
4. If needed, run _'docker exec **XX** symfony console app:request-exchange-currency-data'_ to manually run the command to obtain currency rates (this command is called automatically every day at midnight)


## Testing

To start tests, you need to run a 'php bin/phpunit **TestClass**' command, where **TestClass** is path to your test class


## Contacts

