## INSTRUCTIONS TO RUN CODE 

note : I use Laravel Homestead to run my code

1. Install & configure Laravel Homestead ( https://laravel.com/docs/8.x/homestead )
2. Run command "vagrant up", "vagrant ssh" and git clone/pull this repo
3. Install PhpMyadmin locally in your Homestead & create product, order_history and order_details table 
4. In product table kindly import the products.sql file in public folder.
5. In order_history table, add column id, user_id, order_date, order_status, created_at, updated_at
6. In order_detail table, add column order_id, item_name, item_name, item_quantity, price_per_item, total_price, cpdated_at and created_at
7. After setting up all the environments, go to Homestead Run "composer install"
8. After that run "php artisan migrate"
9. Make sure the database configuration in .env is correct. 
10. After complete setting up all the environment, run supplycart.test at your browser



