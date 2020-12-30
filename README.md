<p align="center">
    <img align="center" src="https://supplycart.my/wp-content/uploads/2019/09/sc_logo_tm.png">
</p>

# Instructions on how to run

[Docker](https://docs.docker.com/get-started/) is required to run this locally.

Alternatively, it is deployed on [Linode](http://172.104.190.128/)
```bash
#!/usr/bin/env bash

composer install
php artisan sail:install
alias sail='bash vendor/bin/sail'
sail up

```

Once docker-compose finishes getting all the dependencies, continue with the following steps:

```sh
sail php artisan key:generate
```

Change the `DB_HOST` in `.env` to be `mysql` (Docker-composed defined networking. You can connect to it via localhost:3306 as well)

## DB Migration
```sh
sail php artisan migrate
sail php artisan db:seed
```

## Compile the static assets
```sh
npm ci
npm run dev
```

You can now visit the site on [localhost](localhost)
## Login(s)

There are three pre-defined usernames available:

normal@discount.com

5percent@discount.com

10percent@discount.com

Password is `password`

Each user will have different prices

## Registration

Firstly, set your .env to use these:

```env
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=noreply@supplytruck.xyz
MAIL_FROM_NAME="${APP_NAME}"
```

Upon registering, you should see an email sent to [PostHog (localhost)](localhost:8025)

Notes on deployed server .. Linode blocks all SMTP port by default so I will not be able to send it. If you need verification it is possible, send me an email and I'll send my SendGrid API key over for testing.
## Tests

Unfortunately, HTTP tests cant be done. Have yet to pinpoint the cause of failing tests. Suspect Sail/Docker to be culprit

# Supplycart Interview Case Study

This case study is designed for candidates to showcase their skills and coding style focusing on Laravel, Vue and TailwindCSS. You may use more technologies apart from the 3 mentioned.

### Instructions

- Fork this repo to your github account
- Complete the tasks given
- Once completed, create a PR to this repository
- Lastly, add some guidance or instruction on how to run your code

### Requirements

You must work on this assignment using:
 - Vue (optional for BE dev)
 - TailwindCSS
 - Laravel (optional for FE dev)

### Tasks

1. As guest, I want to be able to register an account
2. As guest, I want to be able to login using registered account
3. As user, I want to see list of products after login
4. As user, I want to be able to add product to cart
5. As user, I want to be able to place order for added products in cart
6. As user, I want to see my order history
7. As user, I want to be able to logout

### Bonus Tasks

1. Verify email after registration
2. User activity log e.g. login, logout, add to cart, place order etc
3. Product attributes and filtering e.g brand, category
4. Different user can see different price for products
5. Add unit tests
6. Deploy app to a server
