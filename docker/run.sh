#!/bin/sh

cd /var/www

composer install

php artisan migrate --seed

npm install

npm run build

/usr/bin/supervisord -c /etc/supervisord.conf --silent
