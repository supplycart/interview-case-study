1) Enter composer install

2) Remove .env.example

3) Add Mail smtp like format below:
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME= your_email
MAIL_PASSWORD= your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS= your_email
MAIL_FROM_NAME="${APP_NAME}"

4) php artisan migrate
5) you might need to add category and product in Database Or import the sql in project directly