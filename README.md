## Laravel API Starter

Small demo of a Laravel API, using Dingo and JWT for authentication.

## Installation

### Step 1: Clone the repo
```
git clone https://github.com/od3n/laravel-api-starter
```

### Step 2: Prerequisites
```
composer install
php -r "copy('.env.example', '.env');"
nano .env
php artisan migrate
php artisan db:seed
php artisan key:generate
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
php artisan jwt:generate
```

### Step 3: Serve
```
php artisan serve
```