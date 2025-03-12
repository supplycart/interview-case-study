<p align="center">
    <img align="center" src="https://supplycart.my/wp-content/uploads/2019/09/sc_logo_tm.png">
</p>

# Supplycart Interview Case Study

This case study is designed for candidates to showcase their skills and coding style focusing on Laravel, Vue and TailwindCSS. You may use more technologies apart from the 3 mentioned.

## Working Instructions

The case study is developed using Laravel 12 + VueJS out of the box.

For information on project development, you may refer to: [ClickUp](https://sharing.clickup.com/9018718543/l/h/8crxeaf-318/2bb8b3dfefb8a3d)

For API documentation, I can provide upon request. I'm not sure how exactly to share it publicly.

### Online Test

You may go to: https://supply-cart-case-study.reisdev.xyz/ to access the system. 

### Why there's no email sending in the test site?

Due to DigitalOcean recently blocked SMTP ports, Mailgun configuration cannot follow the default out-of-the-box setup. That's why email may appear not being sent on the [test site](https://supply-cart-case-study.reisdev.xyz/). I instead just linked it to my mailtrap account. Therefore if you wish to test, please let me know so I can give you the verification link or you can clone the project and use your own mailtrap/mailgun credentials in the .env file.

<p>
    <img align="center" src="public/assets/notes/smtp port blocked.png">
    You may refer here for more information: <a href="https://docs.digitalocean.com/support/why-is-smtp-blocked/">docs.digitalocean.com/support/why-is-smtp-blocked</a>
</p>

### Local Test

If you want to test the system on local please follow the next part of the instruction:

After you've pulled the repository, please ensure that you have:
- PHP 8.2 or above
- NPM 8.18.0 | Node 18.8.0

Initialize the project by running:
- `composer install`
- `npm install`
- `npm run dev` (if you want to develop)
- `npm run build` (if you want to test only)
- `cp .env.example .env`
- `php artisan key:generate`
- `nano .env`
- `php artisan migrate --seed`
- `php artisan serve`
- `php artisan test` (to run unit tests)

You may then access the system through `http://localhost:8000`.

## `nano .env`

You may refer here for sample content of your `.env`

```
APP_NAME="Supply Cart Case Study"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
# APP_MAINTENANCE_STORE=database

PHP_CLI_SERVER_WORKERS=4

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

# DB_CONNECTION=sqlite
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=supply_cart_case_study
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
# CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_SCHEME=null

# you may use this configuration if using mailtrap
# MAIL_MAILER=smtp
# MAIL_HOST=sandbox.smtp.mailtrap.io
# MAIL_PORT=2525
# MAIL_USERNAME=<MAILTRAP INBOX USERNAME GOES HERE>
# MAIL_PASSWORD=<MAILTRAP INBOX PASSWORD GOES HERE>
# MAIL_FROM_ADDRESS="hello@example.com"
# MAIL_FROM_NAME="${APP_NAME}"

# you may use this configuration if using mailgun
# MAILGUN_DOMAIN=<MAILGUN DOMAIN GOES HERE>
# MAILGUN_SECRET=<MAILGUN API KEY GOES HERE>

# MAIL_MAILER=smtp
# MAIL_HOST=smtp.mailgun.org
# MAIL_PORT=587
# MAIL_USERNAME=<MAILGUN DOMAIN SMTP CREDENTIALS USERNAME GOES HERE>
# MAIL_PASSWORD=<MAILGUN DOMAIN SMTP CREDENTIALS PASSWORD GOES HERE>
# MAIL_FROM_ADDRESS="hello@example.com"
# MAIL_FROM_NAME="${APP_NAME}"

MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=<MAILTRAP INBOX USERNAME GOES HERE>
MAIL_PASSWORD=<MAILTRAP INBOX PASSWORD GOES HERE>
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"

# packages env
ACTIVITY_LOGGER_ENABLED=true
```

# Original Instructions

## Instructions

- Fork this repo to your github account
- Complete the tasks given
- Once completed, create a PR to this repository
- Lastly, add some guidance or instruction on how to run your code

## Requirements

You must work on this assignment using:
- Vue (optional for BE dev)
- TailwindCSS
- Laravel (optional for FE dev)

## Tasks

1. As guest, I want to be able to register an account
2. As guest, I want to be able to login using registered account
3. As user, I want to see list of products after login
4. As user, I want to be able to add product to cart
5. As user, I want to be able to place order for added products in cart
6. As user, I want to see my order history
7. As user, I want to be able to logout

## Bonus Tasks

1. Verify email after registration
2. User activity log e.g. login, logout, add to cart, place order etc
3. Product attributes and filtering e.g brand, category
4. Different user can see different price for products
5. Add unit tests
6. Deploy app to a server

## Key Evaluation Criteria

While completing the above tasks, we will be particularly looking at how you handle the following aspects:

1. **Data Validation**: Proper validation of user inputs and data integrity checks.

2. **Data Transformation**: Efficient and logical transformation of data between different parts of the application.

3. **Query Efficiency**: Optimization of database queries, including proper use of Laravel's query builder and Eloquent ORM features.

4. **Consistent Naming Convention**: Use of snake_case for database columns, camelCase for PHP and JavaScript variables, and adherence to Laravel and Vue.js naming conventions.

5. **Proper Handling of Monetary Values**: Accurate representation and calculation of prices and totals.

6. **Database Design**: Well-structured migration files that demonstrate thoughtful schema design, including appropriate indexes.

7. **Code Organization**: Clear, modular, and maintainable code structure.

8. **Security Best Practices**: Implementation of necessary security measures to protect against common vulnerabilities.

9. **API Design** (if applicable): RESTful design principles and clear documentation.

10. **Error Handling**: Graceful error handling and informative error messages.

## Submission Guidelines

- Ensure your code is well-commented and follows PSR-12 coding standards for PHP.
- Include a README.md file with setup instructions and any assumptions made.
- If you have suggestions for improving this case study, feel free to include them in your submission.

We look forward to reviewing your implementation and discussing your approach during the interview process.

---

P/S: If you think there is a better way for us to assess your technical skills, feel free to suggest. We are constantly looking to improve our interview process.
