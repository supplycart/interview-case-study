<p align="center">
    <img align="center" src="https://supplycart.my/wp-content/uploads/2019/09/sc_logo_tm.png">
</p>

# Running the App

There are 2 ways to running this project: **using Docker** or **without using Docker**

The recommended way is **using the Docker** because you don't need to install any dependencies into your local machine.

## Using Docker

```bash
# Make sure you don't have any app using the below ports before running the command:
#   - 8000
#   - 3306 (MySQL default port)

# Run either of the below command & wait about 1 minutes until all of the containers have started.
# Container list:
#   - supplycart_mysql
#   - supplycart_app

$ docker compose up --build

# OR

# run this instead if you don't want to check the container's log
$ docker compose up --build --detach
```

## Without Docker

```bash
$ composer install
$ pnpm install && pnpm run build
$ php artisan migrate && php artisan db:seed
$ composer run dev # or 'php artisan serve'
```

# Accessing the app

Go to `http://localhost:8000` in your browser.

# Tech Stack

1. MySQL v9.2
2. Laravel PHP Framework v11
3. PHP v8.4
4. VueJS v3.5
5. Inertia.js v2

# ERD

![erd.svg](erd.svg 'erd.svg by dbdiagram.io')

# Suggestions on improving this Case Study

Allow DevOp or Senior SOftware Engineer to showcase their skill by adding a `Bonus Task` to run the application using `Docker container` or `Docker compose`.

Since most people might not have their personal server, it will be good if Supplycart able to test them whether they are able to at least build & run a Docker container on their localhost since once you have run a container, it'll always run as expected no matter the environment (technically, you can just plug & play the container to any server to deploy them).

### Reason

Most free servers that I know of that can actually run Laravel or PHP app does not comes with a free package for both MySQL DB server & PHP server (we used to be able to do this on Heroku before the Free tier was removed).

Assuming the app is able to be built & run within the container itself, we can definitely be sure that it'll run properly in any environment that supports container apps. Also, by using docker compose, we can definitely spin up a very small container of DB server (in this project's case MySQL) for free.

---

# Supplycart Interview Case Study

This case study is designed for candidates to showcase their skills and coding style focusing on Laravel, Vue and TailwindCSS. You may use more technologies apart from the 3 mentioned.

## Instructions

- Fork this repo to your github account
- Complete the tasks given
- Once completed, create a PR to this repository
- Lastly, add some guidance or instruction on how to run your code

## Requirements

You must work on this assignment using:

- Vue (optional for BE dev)
- TailwindCSS
- Laravel (optional for FE dev)

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

- Ensure your code is well-commented and follows PSR-12 coding standards for PHP.
- Include a README.md file with setup instructions and any assumptions made.
- If you have suggestions for improving this case study, feel free to include them in your submission.

We look forward to reviewing your implementation and discussing your approach during the interview process.

---

P/S: If you think there is a better way for us to assess your technical skills, feel free to suggest. We are constantly looking to improve our interview process.
