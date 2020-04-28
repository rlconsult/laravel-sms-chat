# Filament

A lightweight admin for your Laravel app.

## _[This package is in very active development – we would love help to make it awesome!]_

---

## Installation in laravel

This package can be used with `Laravel 7.x` or higher.

> The following instructions assume a new installation of Laravel with database and mail setup.

```bash
composer require filament/filament dev-master
php artisan migrate
php artisan vendor:publish --tag=filament-seeds
composer dump-autoload
php artisan db:seed --class=FilamentSeeder
```

Add the necessary `Filament\Traits\FilamentUser` trait to your `App\User` model.

---

## Create a user

```bash
php artisan filament:user
```
