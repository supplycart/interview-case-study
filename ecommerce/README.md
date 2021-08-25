# README

## Tasks Completed

All required tasks are completed as follow:

1. Account registration.
2. Account login.
3. Product dashboard which displays a default list of products.
4. Adding product to cart.
5. Place order for all products in cart.
6. Order history.
7. Account logout.

Bonus tasks are not attempted but some additional tasks are completed as follow:

1. Remove product from cart.
2. Update the quantity of product in cart.
3. Clear the cart.

<br />

## Frameworks and Packages

- Laravel 8
- Tailwind CSS
- MySQL
- [laravelshoppingcart](https://github.com/darryldecode/laravelshoppingcart)

<br />

## Run

1. Before running, a local database will need to be configured.
    - For my case, I have used the MySQL database and administrate it over the web using phpMyAdmin. I then logged onto the phpMyAdmin website and create a database called 'ecommercedb'.
        - Installation of [MySQL with phpMyAdmin](https://www.javahelps.com/2018/10/install-mysql-with-phpmyadmin-on-ubuntu.html)
        - Configuration of database name, user, password, etc. at `.env.example` file

2. After that, run the following commands.

    ```php
    cd ecommerce
    composer install
    php artisan migrate
    php artisan serve
    ```

3. The application can then be accessed at http://127.0.0.1:8000/login

<br />

## References

As I am new to all these concepts, I have referred to various resources while attempting the tasks.

1. Account authentication: https://www.positronx.io/laravel-custom-authentication-login-and-registration-tutorial/ 
2. Shopping cart: https://larainfo.com/blogs/laravel-8-add-to-cart-step-by-step-example  
3. Placing orders: https://meritocracy.is/blog/2021/06/08/laravel-implementing-a-shopping-cart-for-your-website/ 
