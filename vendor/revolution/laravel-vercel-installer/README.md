# Laravel Vercel Installer

[![Maintainability](https://api.codeclimate.com/v1/badges/9b0a78d5e14c3c85fe4f/maintainability)](https://codeclimate.com/github/kawax/laravel-vercel-installer/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/9b0a78d5e14c3c85fe4f/test_coverage)](https://codeclimate.com/github/kawax/laravel-vercel-installer/test_coverage)

Install some files to run Laravel on Vercel.

## Requirements
- PHP >= 8.2
- Laravel >= 10.0

## Installation

```shell
composer require revolution/laravel-vercel-installer --dev

php artisan vercel:install
```

### Uninstall
```shell
composer remove revolution/laravel-vercel-installer --dev
```

## vercel.json
It will probably not work with the new spec that uses `functions` and `rewrites` in vercel.json.

### regions
https://vercel.com/docs/edge-network/regions

### builds
`vercel-php@0.7.2` is PHP8.3

To use another version, check this repository.
https://github.com/vercel-community/php

### routes
If there are other files in public, add them to routes.

```json
    {
        "src": "/images/(.*)",
        "dest": "/public/images/$1"
    },
```

### env
Secret env is set in the vercel settings page.

`php artisan key:generate --show` command generates a new key without updating the .env file. Set this key on the Settings page `APP_KEY`.

## Database
You can use Vercel Postgres or AWS RDS.

https://vercel.com/docs/storage/vercel-postgres

## Cache and session
You can't use the `file` driver.

If you're using a database, you can use the `database` driver.

## TrustProxies

### Laravel 10
If you have any problems with TrustProxies, change `/app/Http/Middleware/TrustProxies.php`.

```php
class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array<int, string>|string|null
     */
    protected $proxies = '*';

```

### Laravel 11
Change `/bootstrap/app.php`
```php
->withMiddleware(function (Middleware $middleware) {
        $middleware->trustProxies(at: '*');
    })
```

## API prefix
If you use Laravel's API routes, you will need to change the `/api/` route as it conflicts with Vercel.

### Laravel 11
`/bootstrap/app.php`

```php
use Illuminate\Foundation\Application;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        api: __DIR__.'/../routes/api.php',
        apiPrefix: 'prefix/api',
        health: '/up',
    )
```

## LICENSE
MIT  
