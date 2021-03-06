# Local Dynamizer Admin Panel

![PUSH Workflow](https://github.com/jmcerrejon/localdynamizer/workflows/PUSH%20Workflow/badge.svg?branch=master)

This panel (only in Spanish atm) tries to help community managers to manage their clients' social networks. For now it's a proof of concept with sections to import resources that can serve them, an agenda to keep appointments and a database with clients (here called stores).

-   Site under development at: https://dinamizadorlocal.com (Ask me for a user if you want to test it).

-   ⏰ Estimated hours of work so far: 143 hours.

-   More screenshots on [screenshots directory](./screenshots).

![Local](./screenshots/screenshot_08.png)

![Local](./screenshots/screenshot_02.png)

![Local](./screenshots/screenshot_05.png)

## Prerequisites

-   Modify on _php.ini_ date.timezone = "Europe/Madrid"

## Install

```sh
git clone https://github.com/jmcerrejon/localdynamizer.git
composer update && npm install
cp .env.example .env # Add your MySQL config
php artisan key:generate
php artisan migrate --seed
php artisan storage:link # If you have a /public_html dir, skip this command and check the next section
composer dump-autoload
```

#### Storage link in /public_html

Maybe your hosting has a _public_html_ directory, so we can't use public. Don't worry, try the next:

```sh
ln -s $PWD/storage/app/public/ $PWD/public_html/storage
sudo chmod -R 775 storage
```

#### 403 issues

It's a knighmare. Some tips:

```sh
chown -R $USER:$(id -gn $USER) storage
chown -h $USER:$(id -gn $USER) storage
find * -type d -exec chmod 755 {} \;
find * -type f -exec chmod 644 {} \;
```

On **production** environment an extra step maybe is required:

Install packages:

```sh
sudo apt install -y php7.4-zip php-xml php7.4-gd
```

Change time-zone (Debian):

```sh
timedatectl set-timezone "Europe/Madrid"
timedatectl | grep "Time"
timedatectl  status
```

Now:

```sh
npm run production
php artisan config:cache # Run this when update files inside /config
```

## Development

-   You can use _http://yourdomain.test/auto-login_ to skip login form and go directly to home.

## Interesting Packages and Libraries used

Check _composer.json_ for more pkgs.

-   https://flickity.metafizzy.co/

-   https://sean.is/poppin/tags

-   https://github.com/michalsnik/aos/tree/v2

-   https://github.com/spatie/laravel-searchable

-   https://github.com/fiduswriter/Simple-DataTables

-   https://docs.laravel-excel.com/3.1/getting-started/

-   https://unisharp.github.io/laravel-filemanager/

-   https://github.com/DarkaOnLine/L5-Swagger (Help me a lot [this post](https://ivankolodiy.medium.com/how-to-write-swagger-documentation-for-laravel-api-tips-examples-5510fb392a94) on Medium)

-   https://github.com/enlightn/enlightn

## API Documentation

Formerly called _Swagger_ (quite often called this even now), _OpenAPI_ is a standard of documenting _APIs_. Its specification is available on _Github_ [here](https://github.com/OAI/OpenAPI-Specification).

The _OpenAPI Specification_ is a broadly adopted industry standard for describing modern _APIs_.

URL: https://dinamizadorlocal.com/api/docs

Generate: `npm run generate-documentation`

## Credits

👨🏻‍💻 Jose Manuel Cerrejon Gonzalez

✉️ jmcerrejon@icloud.com

📍 Huelva, Spain

Dev with ♥️ using [Laravel](https://www.laravel.com), AdminLTE for panel and landing/Admin panel with [Tailwind CSS](https://tailwindcss.com).

## Licence

### Commercial license

If you want use this panel in commercial products, projects, and applications, the _Commercial license_ is the appropriate license. With this option, your source code is kept proprietary. To purchase a commercial license you need to buy a licence from the owner. [Contact for licence](info@dinamizadorlocal.com)

### Open-source license

Free just for educational and **non-commercial purpose**.
