<p align="center">
    <img align="center" src="https://supplycart.my/wp-content/uploads/2019/09/sc_logo_tm.png">
</p>

# Supplycart Interview Case Study

This case study is designed for candidates to showcase their skills and coding style focusing on Laravel, Vue and TailwindCSS. You may use more technologies apart from the 3 mentioned.

## Setup Instructions

1. Generate key, migrate, and run seeder for the DB. 
php artisan key:generate
php artisan migrate
php artisan db:seed

2. Start servers
Backend: php artisan serve
Frontend: npm install && npm run dev

2. Login:
Email: test@example.com
Password: Test123#

3. Play around with it. 

4. Run unit tests
./vendor/bin/pest 

## Assumptions
The products page should be displayed even if the user isn't logged in, simulating actual ecommerce behaviour.
If add to cart or other navbar buttons are clicked, it will redirect user to login. 
Only 1 brand, and 1 category per product.
