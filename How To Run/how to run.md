## Requirement
This packages required to run the application:
- node.js

## Setting up the enviroment
### Backend
1. Open a console and go to the backend folder with `cd backend` from the root folder
2. Run `composer install` to install the required dependencies for backend
3. Create a .env file in the root of backend folder
4. Paste the content of the *enviroment_file* into the .env file

### Frontend
1. Open another console and go to the frontend folder with `cd frontend` from the root folder
2. Run `npm install craco --save` to install craco dependencies
3. Run `
   npm install -D tailwindcss@npm:@tailwindcss/postcss7-compat postcss@^7 autoprefixer@^9` to install tailwind css
4. Run `npm install axios --save` to install axios
5. Run `npm install sweetalert --save` to install sweetalert

## Setting up the database
1. Install xampp from (https://www.apachefriends.org/index.html)
2. Start the Apache and MySQL module
3. Click on the admin button for MySQL module to go to local php admin
4. Create a new database called supplycart
5. Run `php artisan migrate` to migrate the models
6. Run `php artisan db:seed` to generate fake product data into the database

## Running the server
### Backend
1. Using the console to setup the backend enviroment run `php artisan serve` to start the backend server

### Frontend
1.  Using the console to setup the frontend enviroment run `php artisan serve` to start the frontend server

You can run the apps in the browser through (http://localhost:3000/register) to register an account
or (http://localhost:3000/home) to see the home page

**Note**:
- logs generated will be printed to syslog.log and errorlog.lo file in backend logs folder