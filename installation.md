# Installation

## Prerequisites
- PHP 8.2 or higher
- Composer
- NPM v8.1.0 or higher
- MySQL

## Steps
1. Clone the repository
2. Copy the `.env.example` file to `.env` and update the database configuration
3. Run `composer install`
4. Run `php artisan key:generate`
5. Run `npm install && npm run build`
6. Run `php artisan migrate --seed`
7. Run `php artisan serve`
8. Visit `http://localhost` (or whatever your setup is) in your browser
9. Login to the application using the following credentials:
   - Email: `test@example.com`
   - Password: `password`

## Assumptions
- The application is running on a local development environment
- The database is MySQL
