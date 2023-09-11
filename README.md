# MUJI Online Store Clone

This project is a clone of the MUJI Online Store, focusing on implementing various features using Laravel, Vue.js, and Tailwind CSS. It includes user registration, login, product listing, cart management, order placement, order history, and user logout functionalities.

## Table of Contents

-   [Requirements](#requirements)
-   [Installation](#installation)
-   [Features](#features)
-   [Future Improvements](#future-improvements)

## Requirements

To run this project, you will need the following technologies:

-   Vue.js
-   Tailwind CSS
-   Laravel
-   Inertia.js

## Installation

1. **Fork this repository**: Start by forking this repository to your own GitHub account.

2. **Clone the repository**: Clone the forked repository to your local machine.

    ```bash
    git clone https://github.com/your-username/muji-online-store-clone.git

    ```

3. **Install dependencies**: Navigate to the project directory and install the required dependencies for both the backend and frontend.

    ```bash
    # Install backend dependencies
    cd backend
    composer install


    # Install frontend dependencies
    cd ../frontend
    npm install

    ```

4. **Database Setup**: Set up your database configuration in .env file in the backend directory. Then, run migrations and seed the database.

    ```bash
    # In the backend directory
    php artisan migrate --seed

    ```

5. **Start the Development Servers**: Run the Laravel backend and Vue.js frontend development servers.

    ```bash
    # In the backend directory
    php artisan serve


    # In the frontend directory
    npm run dev

    ```

6. **Access the Application**: Open your web browser and navigate to http://localhost:8000 to access the application.

## Usage

1. **User Registration and Login**: You can register a new account as a guest and then log in using your registered account.

2. **Product Listing**: After logging in, you will be able to browse a list of products available on the MUJI Online Store.

3. **Adding Products to Cart**: As a user, you can add products to your cart for later purchase.

4. **Placing Orders**: You can place orders for the products in your cart. Note that this is a simulated feature and does not involve actual payment processing.

5. **Order History**: You can view your order history to see past orders you've placed.

6. **Logout**: When you're done, you can log out of your account.

## Future Improvements

While this project covers a significant portion of the required tasks, there are still some areas that can be improved or extended:

-   Implement email verification for registered users.
-   Implement user activity logging for actions like login, logout, adding items to the cart, and placing orders.
-   Enhance product attributes and filtering, such as by brand and category.
-   Implement differential pricing for products based on user roles.
-   Add unit tests to ensure the reliability of the application.
-   Deploy the application to a server for public access.
    > > > > > > > 5c7ed87 (final commit)
