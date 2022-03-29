# Supply Cart Mall

Hosted on **Heroku**: http://supply-cart-mall.herokuapp.com/

## Credentials

You can register yourself, but here are the credentials

**Customer**

- email: tester1@gmail.com
- password: 12345abc

**Member**

- email: tester2@gmail.com
- password: 12345abc

**RM 10 Voucher**

Code: SupplyCartIsGood

### Running Locally

1. Create a .env file and create corresponding table 
2. Run 

```cmd
composer install
php artisan migrate --seed
```

3. Run it in xampp or with the following artisan code

```cmd
php artisan serve
```

### Tasks

- [x] As guest, I want to be able to register an account 
- [x] As guest, I want to be able to login using registered account 
- [x] As user, I want to see list of products after login
- [x] As user, I want to be able to add product to cart
- [x] As user, I want to be able to place order for added products in cart
- [x] As user, I want to see my order history
- [x] As user, I want to be able to logout

### Bonus Tasks

- [ ] Verify email after registration
- [x] User activity log e.g. login, logout, add to cart, place order etc
- [x] Product attributes and filtering e.g brand, category
- [x] Different user can see different price for products
- [x] Add unit tests
- [x] Deploy app to a server

### Extra Features

- Implemented middlewares, resources, requests, seeders and factories
- Implemented pagination
- Implemented voucher system
- Usage of VueRouter for routing
- Update Cart

When building the website, my previous experience in Wordpress inspired me
with the structure in carts and voucher usage.
