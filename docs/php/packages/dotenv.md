# [vlucas/phpdotenv](https://github.com/vlucas/phpdotenv)

```
composer require vlucas/phpdotenv
```

```php
$env = \Dotenv\Dotenv::createImmutable(__DIR__);
$env->load();
var_dump($_ENV['MY_PARAM']);
```

```php
$env = \Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$env->load();
var_dump(getenv('MY_PARAM'));
```
