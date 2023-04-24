# Installation
After the clone project run
```sh
composer install
cp .env .env.example
php artisan key:generate
```
Open **.Env** file and set the next variables for configuring MySQL
```sh
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```
Run command
```sh
php artisan migrate --seed
npm install
npm run dev
php artisan serve
```
