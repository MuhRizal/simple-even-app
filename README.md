### How to create new instance? ###
This code uses Laravel 8

### Specification ###
- PHP 7.4.x
- mysql 5.7.x
- composer

### Create directory in server and pull the master branch ###

```
cd /var/www/html  
mkdir new_directory // create new directory for this instance
cd new_directory
git init
git remote add origin https://github.com/MuhRizal/simple-even-app.git
git pull origin main

```

### Create the database and update .env file inside directory ###
Create .env file inside directory, get the contecnt from .env.example file. Set the configuration.
```

DB_DATABASE=yourDatabaseName
DB_USERNAME=yourDbUsername
DB_PASSWORD=yourDbPassword
```

### Set permission in this laravel directory if you are using linux ###

```
sudo chgrp -R www-data storage bootstrap/cache
sudo chmod -R ug+rwx storage bootstrap/cache
```

### Installation
if composer is not installed in the server : apt install composer

```
composer install
composer update
npm install
npm run prod
php artisan migrate
php artisan db:seed
```

### Apache configuration
- /etc/apache2/sites-enabled/000-default.conf
- /etc/apache2/sites-enabled/000-default-le-ssl.conf
Then restart apache
```
sudo systemctl restart apache2
```

### Clear laravel cache
```
php artisan view:clear
php artisan config:clear
composer dumpautoload -o
```
