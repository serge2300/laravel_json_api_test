#!/usr/bin/env bash

php composer.phar install
php artisan key:generate
php artisan migrate
php artisan db:seed --class=UsersTableSeeder