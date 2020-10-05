## Setup

- `composer install`

- `cp .env.example .env`

- `php artisan key:generate`

- Create new database

- Edit `.env` with your database configuration:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=<your database name>
DB_USERNAME=root
DB_PASSWORD=
```

- Migrate database `php artisan migrate`
- php artisan db:seed --class="ProductsSeeder"