# Создание нового проекта

Установка
```
docker run --rm --interactive --tty \
  --volume $PWD:/app \
  --volume ${COMPOSER_HOME:-$HOME/.composer}:/tmp \
  composer create-project --prefer-dist laravel/laravel pwa
```

```
sudo chown -R $USER:$USER pwa
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