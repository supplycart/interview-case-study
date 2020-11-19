<p align="center">
    <img align="center" src="https://supplycart.my/wp-content/uploads/2019/09/sc_logo_tm.png">
</p>

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
6. As user, I want to user my order history
7. As user, I want to be able to logout

### Bonus Tasks

1. Verify email after registration
2. Product attributes and filtering e.g brand, category
3. Different user can see different price for products
4. Add unit tests
5. Deploy app to a server


## INSTRUCTIONS TO RUN CODE 

note : I use Laravel Homestead to run my code

1. Install & configure Laravel Homestead ( https://laravel.com/docs/8.x/homestead )
2. Run command "vagrant up", "vagrant ssh" and git clone/pull this repo
3. Install PhpMyadmin locally in your Homestead & create product, order_history and order_details table
4. In product table, add column id, product_name, product_price, product_brand, product_image, product_stock, created_at and updated_at
5. In order_history table, add column id, user_id, order_date, order_status, created_at, updated_at
6. In order_detail table, add column order_id, item_name, item_name, item_quantity, price_per_item, total_price, cpdated_at and created_at
7. After setting up all the environments, go to Homestead Run "composer install"
8. After that run "php artisan migrate"
9. Make sure the database configuration in .env is correct. 
10. After complete setting up all the environment, run supplycart.test at your browser


