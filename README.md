# Supplycart System

This is a Laravel, Vue, and TailwindCSS-based system designed to manage user authentication, product browsing, cart management, and order processing.

## Requirements

Ensure you have the following installed:

-   PHP 8.1 or higher
-   Composer
-   Node.js and npm
-   MySQL database

## Installation

Follow these steps to set up the project:

1. **Clone the repository**:

    ```
    git clone https://github.com/yourusername/supplycart.git
    cd supplycart
    ```

2. **Install PHP dependencies** -
   Run the following command to install the necessary Laravel dependencies:

    ```
    composer install
    ```

3. **Install JavaScript dependencies** -
   Use npm to install the required frontend packages:

    ```
    npm install
    ```

4. **Set up environment variables** -
   Copy the `.env.example` file and update it as needed:

    ```
    cp .env.example .env
    ```

    Update the `.env` file with your database and other relevant configuration:

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=supplycart
    DB_USERNAME=root
    DB_PASSWORD=yourpassword

    # Other configurations
    APP_URL=http://localhost
    ```

5. **Generate application key** -
   Run the following command to generate an application key:

    ```
    php artisan key:generate
    ```

6. **Run database migrations** -
   Set up the database tables by running the migrations:

    ```
    php artisan migrate
    ```

7. **Seed the database** -
   Populate the database with sample data:

    ```
    php artisan db:seed --class=ProductSeeder
    php artisan db:seed --class=UserSeeder
    ```

8. **Build frontend assets** -
   Compile the Vue and TailwindCSS assets:

    ```
    npm run dev
    ```

9. **Start the development server** -
   Launch the Laravel server:

    ```
    php artisan serve
    ```

    The application will be accessible at [http://localhost:8000](http://localhost:8000).

## Running Tests

To run the unit tests for the application:

```
php artisan test
```

## Seeded Users (Based on User Tiers)

Basic Tier:

```
Email: basic@supplycart.azushi.com
Password: basic
```

Silver Tier:

```
Email: silver@supplycart.azushi.com
Password: silver
```

Gold Tier:

```
Email: gold@supplycart.azushi.com
Password: gold
```

Platinum Tier:

```
Email: platinum@supplycart.azushi.com
Password: platinum
```

## Features

-   **User Authentication**: Registration, login, and logout functionality.
-   **Product Management**: Browse and view a list of products.
-   **Cart and Orders**: Add products to the cart, place orders, and view order history.
-   **Bonus Features**:
    -   Email verification after registration.
    -   User activity log (login, logout, add to cart, etc.).
    -   Product filtering by brand or category.
    -   Custom pricing for different users.

## Deployment

If you wish to deploy the application, follow the steps to set up the environment for production. Make sure to:

-   Run \`npm run build\` to build optimized assets.
-   Ensure proper database and environment configurations.
