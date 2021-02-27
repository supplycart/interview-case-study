# CartZada - Cart system

[![Version on Laravel](https://img.shields.io/badge/Laravel-v8.29-green?style=flat-square)](https://laravel.com/docs/7.*)
[![Version on PHP](https://img.shields.io/badge/php-v7.4.10-blue?style=flat-square)](http://php.net/)

## Dependencies

* mysql >= 8.0
* php >= 7.4
* [Composer](https://getcomposer.org/)
* [NodeJS](https://nodejs.org/en/)

Install the dependencies by running
```
composer install
```

Install the node modules by running
```
npm install
npm run dev
```

## Usage

Make a copy file `.env.example` in the root folder with name `.env` and change all require credentials. Example:

```
...
# URL for website
APP_URL=http://localhost
...

...
# connection
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
...
```

Run command before start

```
php artisan key:generate
php artisan migrate
```

Seeder products

```$xslt
php artisan db:seed --class=ProductSeeder
```

## Development server

Run `php artisan serve` for a easy development server. Navigate to `http://localhost:8000/`. The app will automatically reload if you change any of the source files.
  
Happy coding~...
Good.

## Security

If you discover any security related issues, please email instead of using the issue tracker.

