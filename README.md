# Local Dynamizer Admin Panel

* Site under development at: http://dinamizadorlocal.com (Ask me for a user if you want to test it).

* ⏰ Estimated hours of work so far: 17 hours.

![Local](./screenshots/screenshot_01.png)

![Local](./screenshots/screenshot_03.png)

👨🏻‍💻 Jose Manuel Cerrejon Gonzalez

✉️ jmcerrejon@icloud.com

📍 Huelva, Spain

📚 Creative Commons Attribution-NonCommercial-NoDerivatives 4.0 International Public License ©2020

Dev with ♥️ using [Laravel](https://www.laravel.com)

### Prerequisites

* Modify on *php.ini* date.timezone = "Europe/Madrid"

### Install

```bash
git clone https://github.com/jmcerrejon/localdynamizer.git
composer update && npm install
cp .env.example .env # Add your MySQL config
php artisan key:generate
php artisan migrate --seed
php artisan storage:link # If you have a /public_html dir, skip this command and check the next section
composer dump-autoload
```

#### Storage link in /public_html

Maybe our hosting has a *public_html* directory, so we can't use public. Don't worry, try the next:

```bash
ln -s $PWD/storage/app/public/ $PWD/public_html/storage
sudo chmod -R 775 storage
```

#### 403 issues

It's a knighmare. Some tips:

```bash
chown -R $USER:$(id -gn $USER) storage
chown -h $USER:$(id -gn $USER) storage
find * -type d -exec chmod 755 {} \;
find * -type f -exec chmod 644 {} \;
```

On **production** environment an extra step maybe is required:

Install packages:

```
sudo apt install -y php7.3-zip php-xml php7.3-gd
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

### Development

**NOTE:** Due we need to get this project raise up in a snap, TDD will be added in a near future. [Pest](https://pestphp.com/) is already included and ready to use 😉.
