# Supplycart Interview Case Study

This Laravel application implements a flexible and user-focused cart system for Supplycart. <br> It supports user registration and authentication, product browsing after login, cart management (adding products), order placement, order history viewing, and secure logout functionality.

## Getting Started

These instructions will guide you through setting up and running the project on your local machine after unzipping the files.

## pre-requisites

Make sure you have the following software installed on your computer:

- PHP 8.0 or higher
- Composer
- MySQL
- Node.js and NPM

## Installation Steps
1. Open your terminal and navigate to the project folder: After unzipping, open your terminal and navigate to the project folder:
   <pre> cd path/to/supplycart-cart  </pre>
2. Install PHP dependencies:
   <pre> composer install  </pre>
3. Create a copy of environment file:
    <pre> cp .env.example .env  </pre>
4. Configure the database:
   - Open the .env file with a text editor
   - Set your database credentials:
      <pre>
            DB_CONNECTION=mysql
            DB_HOST=127.0.0.1
            DB_PORT=3307
            DB_DATABASE=cart_supplycart
            DB_USERNAME=your_username
            DB_PASSWORD=your_password
      </pre>
    - Make sure to create the cart_supplycart database in your MySQL server first
5. Generate application key
   <pre> php artisan key:generate  </pre>
6. Run database migration and seed using sample data
   <pre>  php artisan migrate --seed   </pre>
7. Install dependencies
   <pre> composeer install && npm install</pre>
8. Set up Mailtrap for email verification
    - Go to https://mailtrap.io/, log in, and create new inbox
    - Get SMTP settings:
        In Mailtrap > Inboxes > SMTP Settings (choose Laravel from the list for ready-made config).
    - Update your .env file
      <pre>
            MAIL_MAILER=smtp
            MAIL_HOST=sandbox.smtp.mailtrap.io
            MAIL_PORT=2525
            MAIL_USERNAME=your_mailtrap_username
            MAIL_PASSWORD=your_mailtrap_password
            MAIL_ENCRYPTION=tls
            MAIL_FROM_ADDRESS=hello@example.com
            MAIL_FROM_NAME="${APP_NAME}"
      </pre>
 9. compile frontend assets:
     <pre> npm run dev </pre>
10. Run your app
    <pre> php artisan serve </pre>
     
     
