<p align="center">
    <img align="center" src="https://supplycart.my/wp-content/uploads/2019/09/sc_logo_tm.png">
</p>

# Supplycart Interview Case Study

This case study is designed for candidates to showcase their skills and coding style focusing on Laravel, Vue and TailwindCSS. You may use more technologies apart from the 3 mentioned.

## Instructions

-   Fork this repo to your github account
-   Complete the tasks given
-   Once completed, create a PR to this repository
-   Lastly, add some guidance or instruction on how to run your code

## Requirements

You must work on this assignment using:

-   Vue (optional for BE dev)
-   TailwindCSS
-   Laravel (optional for FE dev)

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

-   Ensure your code is well-commented and follows PSR-12 coding standards for PHP.
-   Include a README.md file with setup instructions and any assumptions made.
-   If you have suggestions for improving this case study, feel free to include them in your submission.

We look forward to reviewing your implementation and discussing your approach during the interview process.

---

P/S: If you think there is a better way for us to assess your technical skills, feel free to suggest. We are constantly looking to improve our interview process.

# Installation

```console
$ composer install
$ php artisan migrate
$ php artisan db:seed
```

# Running app

```console
$ composer run dev
```
