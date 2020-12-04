###steps
1. composer install
2. php artisan migrate
3. php artisan db:seed
4. add credentials in .env file for email verification

### Notes
1. at start, user is able to view item list, add items to cart, view cart. upon checkout, user is required to login if they haven't done so.
2. user can register. once registered, an email will be sent for verification.
3. once registered, user can login.
4. a login user can view product list, add to cart, and checkout order.
5. disclaimer: payment system is not included.
 
