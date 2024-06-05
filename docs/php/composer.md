# Composer

## Установка зависимостей на продакшене

```
composer install --no-dev
```

**require-dev** - зависимости, которые не устанавливаются на продакшене при указании ключа --no-dev

## Исправление ошибки Allowed memory bytes exhausted

Fixing the error *"Fatal error: Allowed memory size of 1610612736 bytes exhausted"*
```
COMPOSER_MEMORY_LIMIT=-1 composer require vendor/package
```

## Добавить авторизацию к репозиторию

В файле ~/.config/composer/auth.json добавить

```json
{
    "http-basic": {
        "host.local": {
            "username": "user",
            "password": ""
        }
    }
}
```

## Локальная установка определенной версии

```
wget https://github.com/composer/composer/releases/download/1.8.6/composer.phar
php composer.phar -V
```
