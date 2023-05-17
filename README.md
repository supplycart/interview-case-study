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
6. As user, I want to see my order history
7. As user, I want to be able to logout

### Bonus Tasks

1. Verify email after registration
2. User activity log e.g. login, logout, add to cart, place order etc
3. Product attributes and filtering e.g brand, category
4. Different user can see different price for products
5. Add unit tests
6. Deploy app to a server


P/S: If you think there is a better way for us to asses your technical skills, feel free to suggest. We are constantly looking to improve our interview process.

### Setup Instruction
- Clone Project `git clone https://github.com/fiq265/interview-case-study-supplycart.git`
- Run `composer install`
- Create database, copy `.env.example` and rename to `.env`
- Migrate database, Run `php artisan migrate`
- Run `php artisan migrate --seed` to seed the data in database
- Run `php artisan passport:install` (API Authentication)
- Run `php artisan key:generate` to generate key if required
- Run `php artisan serve` to run the system
- Register account required if database not seeded with the data
- Account information (Seed)
    email: *zali@yahoo.com*
    password: *secret*
