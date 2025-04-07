# SupplyCart Case Study

This project is a Laravel-based application named SupplyCart. It uses MySQL for the database and includes various Laravel features.

//DEMO site
## Demo 
- [SupplyCart Demo Site](https://sandbx.site/)

Note: The email feature is not set up on this demo site. For full functionality, including email-related features, please set up the project locally.

## Requirements

Runs great on:
- PHP 8.1
- Composer 2.2.3
- MySQL 8.0
- Node.js v18.12.0 and npm 8.19.2

## Local Environment Setup

1. **Clone the repository**

   ```bash
   git clone <repository-url>
   cd supplycart-case-study
   ```

2. **Install PHP dependencies**

   ```bash
   composer install
   ```

3. **Install JavaScript dependencies**

   ```bash
   npm install
   ```

4. **Set up the environment file**

   ```bash
   cp .env.example .env
   ```

   Then, edit the `.env` file and update the following variables:

   ```
   APP_NAME=SupplyCart
   APP_URL=http://localhost

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=supplycart_case_study
   DB_USERNAME=root
   DB_PASSWORD=root1234
   ```

5. **Generate application key**

   ```bash
   php artisan key:generate
   ```

6. **Create the database**

   Create a new MySQL database named `supplycart_case_study`.

7. **Run database migrations**

   ```bash
   php artisan migrate
   ```

8. **Compile assets**

   ```bash
   npm run dev
   ```

9. **Start the development server**

   ```bash
   php artisan serve
   ```

   The application should now be accessible at `http://localhost:8000`.


