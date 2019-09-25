# Структура локального пакета

composer.json of main project
```json
    "require": {
        ...
        "yourname/packagename": "*"
    },
    ...
    "repositories": [
        {
            "type": "path",
            "url": "./packages/yourname/packagename"
        }
    ]
```

Folder structure

```text
packages
    yourname
        packagename
            src
                migrations
                Models
                ServiceProvider.php
            composer.json
```

composer.json of package

```json
{
    "name": "yourname/packagename",
    "description": "My nice package",
    "type": "laravel-library",
    "authors": [
        {
            "name": "Your name",
            "email": "yourname@example.com"
        }
    ],
    "minimum-stability": "stable",
    "require": {},
    "autoload": {
        "psr-4": {
            "Yourname\\Packagename\\": "src/"
        }
    },
    "extra": {
        "laravel": {
            "providers": [
                "Yourname\\Packagename\\ServiceProvider"
            ]
        }
    }
}
```

ServiceProvider.php

```php
namespace Yourname\Packagename;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
    }
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . DIRECTORY_SEPARATOR . 'migrations');
    }
}
```