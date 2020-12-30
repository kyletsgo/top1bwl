#!/bin/bash

cd /var/www/html

sudo chown -R ubuntu:ubuntu bootstrap

composer install

sudo chown -R www-data:www-data storage
sudo chown -R www-data:www-data bootstrap

rm -f .env.demo
rm -f .env.production