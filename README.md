# Supply Cart Case Study

## Installation Guide

1. Git clone the project
2. Change to directory `cd supply-cart-interview-case-study`
3. Copy the env file with `cp .env.example .env`
4. Update some notable .env

```
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

# You can use mailtrap for local testing
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME="${APP_NAME}"
```

5. Run `composer install`
6. Generate encrption key by running `php artisan key:generate`
7. Migrate the tables with seeder `php artisan migrate --seed`
8. Run `npm install && npm run build`
9. You can now run the app in `php artisan serve`!

## Tech/Notable Packages used

-   Vue
-   TailwindCSS
-   Laravel
-   Inertia
-   Laravel Breeze (For auth scaffolding)
-   Laravel PEST (For PHPUnit testing)
-   spatie/laravel-activitylog for activity logging
-   Sweetalert
-   Tailwind Headless UI (For transition)

## Dummy accounts

### Silver member (with 5% Discount)

```
username: silver@gmail.com
password: 11111111
```

### Gold member (with 10% Discount)

```
username: gold@gmail.com
password: 11111111
```

### Platinum member (with 15% Discount)

```
username: platinum@gmail.com
password: 11111111
```

## Tasks

-   [x] As guest, I want to be able to register an account
-   [x] As guest, I want to be able to login using registered account
-   [x] As user, I want to see list of products after login
-   [x] As user, I want to be able to add product to cart
-   [x] As user, I want to be able to place order for added products in cart
-   [x] As user, I want to see my order history
-   [x] As user, I want to be able to logout

## Bonus Tasks

-   [x] Verify email after registration
-   [x] User activity log e.g. login, logout, add to cart, place order etc (Added logger into `app/Http/Middleware/HandleInertiaRequests.php`)
-   [x] Product attributes and filtering e.g brand, category
-   [x] Different user can see different price for products (I'm using membership to control discounts)
-   [x] Add unit tests (Can be ran using `./vendor/bin/pest`)
-   [x] Deploy app to a server
