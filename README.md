# Local Dynamizer Admin Panel

👨🏻‍💻 Jose Manuel Cerrejon Gonzalez

✉️ cerrejon@soporttec.es

📍 Huelva, Spain

📚 Copyright ©2020

Dev with ♥️ using [Laravel](https://www.laravel.com)

### Prerequisites

* Modify on *php.ini* date.timezone = "Europe/Madrid"

### Install

```
git clone https://github.com/jmcerrejon/localdynamizer.git
composer update && npm install
cp .env.example .env
php artisan migrate:fresh
php artisan storage:link
composer dump-autoload
chown -R www-data:www-data storage
```

On **production** environment an extra step is required:

Install packages:

```
sudo apt install -y php7.2-zip php-xml php7.2-gd
```

Change time-zone (Debian):

```
timedatectl set-timezone "Europe/Madrid"
timedatectl | grep "Time"
timedatectl  status
```

Now: 

```
npm run production
php artisan config:cache # Run this when update files inside /config 
```
