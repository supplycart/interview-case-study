
## Setup

- `composer install && npm install `

- `cp .env.example .env`

- Edit `.env` with for database and mailtrap :

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls

```

- `php artisan config:cache`

- `php artisan key:generate`

- `php artisan passport:install`

- `php artisan migrate`

- `php artisan db:seed`

- `./vendor/bin/phpunit` for testing

 * Tasks
    * [x] As guest, I want to be able to register an account
    * [x] As guest, I want to be able to login using registered account
    * [x] As user, I want to see list of products after login
    * [x] As user, I want to be able to add product to cart
    * [x] As user, I want to be able to place order for added products in cart
    * [x] As user, I want to user my order history
    * [x] As user, I want to be able to logout

 * Tasks
    * [x] Verify email after registration
    * [x] Product attributes and filtering e.g brand, category
    * [x] Different user can see different price for products (Register user with @test.com to consider as member and will get member price RM 1)
    * [x] Add unit tests
    * [ ] Deploy app to a server
 
