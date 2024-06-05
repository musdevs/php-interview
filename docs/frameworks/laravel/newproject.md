# Создание нового проекта

Установка
```
docker run --rm --interactive --tty \
  --volume $PWD:/app \
  --volume ${COMPOSER_HOME:$HOME/.composer}:/tmp \
  --user $(id -u):$(id -g) \
  composer create-project --prefer-dist laravel/laravel pwa
```

Запуск веб-сервера
```
docker run -it --rm --name pwa \
  -v "$PWD":/app -w /app -p 8000:8000 php \
  php artisan serve --host=0.0.0.0
```

docker-compose run --rm php bash
composer require --dev barryvdh/laravel-ide-helper
composer require barryvdh/laravel-debugbar --dev
composer require laravel/ui --dev

docker-compose run --rm node bash

npm install vue-router --save


npm install fomantic-ui


## Создание проекта на старой версии Laravel

Запуск консоли c PHP 7.1 в docker:

```
docker run --rm -it --pull=always -v "$(pwd)":/opt -w /opt php:7.1-cli bash
```

Установка пакетов Debian, необходимых comoser для установки:

```
apt-get update
apt install -y git zip unzip
```

Установка composer 2.0.1:

```
curl -sS --output composer.phar https://getcomposer.org/download/2.0.1/composer.phar | php \
&& chmod +x composer.phar && mv composer.phar /usr/local/bin/composer
```

Установка Laravel 5.8.35 без установки vendor и выполнения composer-скриптов:

```
composer create-project --prefer-dist --no-install --no-scripts laravel/laravel elisdn-laravel-course-new
```

Сброс прав

```
sudo chown -R $(id -u):$(id -g) my-project
```

## Создание проекта на версиях, выпущенных до 24.02.2022

Запуск консоли c PHP 8.1.3 в docker:

```
docker run --rm -it --pull=always -v "$(pwd)":/opt -w /opt php:8.1.3-cli bash
```

Установка пакетов Debian, необходимых comoser для установки:

```
apt-get update
apt install -y git zip unzip
```

Установка composer 2.2.6, выпущенного до 24.02.2022:

```
curl -sS --output composer.phar https://getcomposer.org/download/2.2.6/composer.phar | php \
&& chmod +x composer.phar && mv composer.phar /usr/local/bin/composer
```

Установка Laravel 8.6.11, выпущенного до 24.02.2022, без установки vendor и выполнения composer-скриптов:

```
composer create-project --prefer-dist --no-install --no-scripts laravel/laravel myproject 8.6.11
```
