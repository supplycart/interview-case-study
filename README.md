# Supplycart Interview Case Study


### Instructions

- Download the code
- Navigate to root directory, run:
```bash
composer install
```
- Create database
- Rename .env.example to .env
- Set up database settings
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```
- Set up environment variables for email service
```bash
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
```
- Generate application key
```bash
php artisan key:generate
```
- Migrate tables and seed database
```bash
php artisan migrate:fresh — seed
```

### Frameworks/Tools used

 - Laravel
 - TailwindCSS
 - VueJS

### Completed Tasks

1. As guest, I want to be able to register an account
2. As guest, I want to be able to login using registered account
3. As user, I want to see list of products after login
4. As user, I want to be able to add product to cart
5. As user, I want to be able to place order for added products in cart
6. As user, I want to see my order history
7. As user, I want to be able to logout

### Completed Bonus Tasks

1. Verify email after registration
2. User activity log e.g. login, logout, add to cart, place order etc
3. Product attributes and filtering e.g brand, category
6. Deploy app to a server

### Demo
[Link](http://old-bird.com/demo/supplycart-interview-case-study)
