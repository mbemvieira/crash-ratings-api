# crash-ratings-api

Laravel 5.5 API that consumes NHTSA API [(Link Here)](https://one.nhtsa.gov/webapi/Default.aspx?SafetyRatings/API/5), collecting crash ratings and displaying then through an API.

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

## PHPUnit tests

Inside project's folder, you can run PHPUnit tests with:

```bash
./vendor/bin/phpunit
```

## API Reference

```
GET <APP-HOSTNAME>/vehicles/<MODEL YEAR>/<MANUFACTURER>/<MODEL>
POST <APP-HOSTNAME>/vehicles
GET <APP-HOSTNAME>/vehicles/<MODEL YEAR>/<MANUFACTURER>/<MODEL>?withRating=true
```
