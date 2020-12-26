I used laragon to run this laravel project 

All basic features and bonus tasks should be completed

Deployed on heroku: http://salty-plains-65750.herokuapp.com/

VIP user credentials (gets 20% discount)
username: vip@test.com
password: password 


**Initial setup**
- Create development db locally which matches database name on .env
- Create a test database locally with the name supply-cart-test
   - Did not use sqlite in memory database because there was an issue with running migration. Apparently, its a     sqlite defect where null value cannot be inserted into non nullbale column even though its the initial migration.  
- Create mailtrap.io account.
    - Ensure that MAIL_USERNAME and MAIL_PASSWORD matches that of mailtrap.io account
    - Ensure there is a MAIL_FROM_ADDRESS value 

- Run php artisan migrate 
- Then, run php artisan seed
- Finally php artisan serve


**Run test**
a) php artisan test
1) windows:  php vendor/phpunit/phpunit/phpunit
