<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

### Instructions

- Clone this repo into your setup
- run composer install
- run npm install
- create and copy .env.example into .env
- run php artisan optimize:clear
- run php artisan migrate:fresh --seed
- run npm run watch

### Requirements

This project use
 - VueJS
 - TailwindCSS
 - Laravel Framework
 - MySQL

### Credential

#Member
- email: member@member.com
- password: password
- Description: this user role can add to cart, remove from cart, place order and view order history (have discount on product)

#Guest
- email: guest@guest.com
- password: password
- Description: this user role can add to cart, remove from cart, place order and view order history

#Admin
- email: admin@admin.com
- password: password
- Description: this user role can add to cart, remove from cart, place order, view order history and view activity log

For demo can access into this url:
http://ecommerce-adib.herokuapp.com
