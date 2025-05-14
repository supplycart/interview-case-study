# SupplyCart Interview Case Study (Laravel)

## Setup Instructions
1. Make sure you have composer install then run the command below to generate `vendor` directory
    ```bash
    composer install
    ```
2. Copy and rename `.env.example` to the folder root.
3. Run the command below to generate `APP_KEY`
    ```bash
    php artisan key:generate
    ```
4. Run the command below to generate Passport's keys
    ```bash
    php artisan passport:keys
    ```
5. Run the command below to run database migration. Make sure you have correct credentials (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`) in your `.env`. 
    ```bash
    php artisan migrate
    ```
    Optionally, you can run database migration with **seeded data** using the command below. [^1]
    ```bash
    php artisan migrate --seed
    ```

**Do take note**, you need to **create and insert manually** Countries, Brands, Categories, Products and Prices into the database if you choose not to run the seeder.

If you choose to run database migration **without database seeder**, run the command below to create Passport Grant Client.
```bash
php artisan passport:client --password --name=SupplyCart --provider=users
```

If you choose to run database migration **with seeder**, Passport Grant Client will be generated at the end of the run command. 

Copy the _Client ID_ and _Client Secret_ for login API request.

## Footnote

[^1]: You can temporarily comment out `backend/database/seeders/DatabaseSeeder.php:24` (User seeder) and/or `backend/database/seeders/DatabaseSeeder.php:25` (Cart and Order seeder) if you don't need them. You can customize and see seeded user credentials at `backend/database/seeders/UserSeeder.php`.
