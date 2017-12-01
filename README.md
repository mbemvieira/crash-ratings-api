# crash-ratings-api

<<<<<<< HEAD
Laravel 5.5 application that consumes NHTSA API, collecting crash ratings and displaying then through an API.
>>>>>>> 9bd1e2c1457785325fcefe6bfc5cc6e39185c1cd

## Environment Requirements

- PHP >= 7.0.0
  - OpenSSL PHP Extension
  - PDO PHP Extension
  - Mbstring PHP Extension
  - Tokenizer PHP Extension
  - XML PHP Extension
- Composer
- Nginx/Apache

 You can use current version of Homestead as well.

## Installation

Clone this repo into your machine:

```bash
git clone https://github.com/mbemvieira/crash-ratings-api
```

Inside your repo folder, run the following commands:

```bash
composer install
cp .env.testing .env
php artisan key:generate
```

## API Reference

```
GET <APP-HOSTNAME>/vehicles/<MODEL YEAR>/<MANUFACTURER>/<MODEL>
POST <APP-HOSTNAME>/vehicles
```
