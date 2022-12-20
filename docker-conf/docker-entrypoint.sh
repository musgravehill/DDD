#!/bin/bash

echo "Hello from ENTRYPOINT"
#cd /var/www/mezzio && composer update 
php-fpm -F
