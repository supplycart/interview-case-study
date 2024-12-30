<p align="center">
    <img align="center" src="https://supplycart.my/wp-content/uploads/2019/09/sc_logo_tm.png">
</p>

# Supplycart Interview Case Study

This case study is designed for candidates to showcase their skills and coding style focusing on Laravel, Vue and TailwindCSS. You may use more technologies apart from the 3 mentioned.

## Setup Instructions

1. Install packages
```bash
$ npm install && composer install
```

2. Make a copy of .env from .env.example
```bash
$ cp .env.example .env
```

3. Set the application key
```bash
$ php artisan key:generate
```
4. Create a sqlite database 
```bash
$ touch database/database.sqlite
```
5. Run migrations
```bash
$ php artisan migrate
```
6. Run database seeder to seed products in the application
```bash
$ php artisan db:seed
```
7. Serve the app by running `npm run dev` and `php artisan serve` in their own terminals
