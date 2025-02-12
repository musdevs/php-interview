# Docker

> Docker - программная платформа для быстрой сборки, отладки и
развертывания приложений. Docker упаковывает библиотеки, системные
инструменты, код и среду исполнения в контейнеры. А сам Docker является
операционной системой для контейнеров.

## Базовые образы

* scratch - образ с абсолютно пустой файловой системой и бинарными файлами
* alpine - небольшой, полноценный дистрибутив
* debian - образ с широкими возможностями

Получение последнего образа PHP:
```
docker pull php:latest
```

Запуск контейнера с монтированием тома из host-системы и исполнением
PHP-скрипта:
```
docker run --priveleged --rm -v $(pwd):/app php:latest php /app/index.php
```
* --privileged - нужен, если на host-системе включена SELinux, вместо
  него можно использовать -v $(pwd):/app:z или -v $(pwd):/app:Z
* --rm - удалить контейнер после запуска
* -v $(pwd):/app - монтировать текущий каталог (результат `$ pwd`) в
  корневой каталог /app
* php /app/index.php - команда, которая будет запущена в контейнере

Запуск контейнера с apache httpd без привязки к терминалу и присвоением
имени контейнеру:
```
docker run -d --name=my-web-server --priveleged --rm -p 38000:80 -v $(pwd):/var/www/html php:apache
```
* -d (detached mode) без привязки к контейнеру
* --name=my-web-server - присвоить контейнеру имя, чтобы было удобнее
  обращаться по имени, а не по ID
* -p 38000:80 - пробросить внутренний порт контейнера 80 на порт
  38000 у host-системы
* $(pwd):/var/www/html - монтирование текущего каталога к каталогу
  DOCUMENT_ROOT в образе php:apache

Запуск контейнера с базой данных MySQL с сохранением данных в хостовой
системе
```
$ docker run -d --rm --name my-db -e MYSQL_USER=admin -e MYSQL_DATABASE=mydb -e MYSQL_PASSWORD=mypass -e MYSQL_RANDOM_ROOT_PASSWORD=true -v $(pwd)/.data:/var/lib/mysql mysql:5.7
```

## Создание собственного образа

Сначала создается Dockerfile
```
FROM php:apache
RUN docker-php-source extract && docker-php-ext-install mysqli && docker-php-source delete
```

Затем создается образ:
```
docker build . -t customvendor/my-app-image
```

Теперь можно запустить контейнер с новым образом:
```
docker run -d --rm --name=my-app -p 38000:80 -v $(pwd):/var/www/html --link my-db customvendor/my-app-image
```
* --link my-db - контейнер my-app связывется с другим контейнером my-db
* customvendor/my-app-image - запускаемый контейнер создается из нового образа customvendor/my-app-image

## Краткий справочник

### Образы
* docker images показывает все образы.
* docker build создаёт образ из файла Dockerfile .
* docker commit создает образ из контейнера, останавливает его, если он запущен.
* docker rmi удаляет образ.
* docker history показывает историю образа.
* docker tag создает тег для образа (локальному или в реестре).

### Жизненный цикл контейнеров

#### docker create создает контейнер, но не запускает его.

#### docker run создает и запускает контейнер за одну операцию.

#### docker rm удаляет контейнер.

##### Удалить все контейнеры, созданные из определенного образа
```
docker ps -aq -f ancestor=php:8.2-cli | xargs docker rm
```

### Запуск и остановка контейнеров
* docker start запускает контейнер, чтобы он работал.
* docker stop останавливает запущенный контейнер.
* docker restart останавливает и запускает контейнер.
* docker pause приостанавливает работу контейнера, «замораживая» его на месте.
* docker unpause возобновляет работу запущенного контейнера.
* docker exec выполняет команду в контейнере.
* docker attach подключается к запущенному контейнеру.
* docker compose - замена устаревшему docker-compose (его новая версия)

### Информация о контейнере

#### docker ps показывает список контейнеров.

##### Запущенные контейнеры
```
docker ps
```

##### Все контейнеры, включая остановленные
```
docker ps -a
```

##### Контейнеры, созданные из образа
```
docker ps -a -f ancestor=php:8.2-cli
CONTAINER ID   IMAGE         COMMAND                  CREATED       STATUS                   PORTS     NAMES
b31a9f90f9da   php:8.2-cli   "docker-php-entrypoi…"   4 weeks ago   Exited (0) 4 weeks ago             inspiring_archimedes
5db05cf07b36   php:8.2-cli   "docker-php-entrypoi…"   4 weeks ago   Exited (0) 4 weeks ago             blissful_beaver
a9708e2ddac2   php:8.2-cli   "docker-php-entrypoi…"   4 weeks ago   Exited (0) 4 weeks ago             mystifying_galois
62850982a373   php:8.2-cli   "docker-php-entrypoi…"   4 weeks ago   Exited (0) 4 weeks ago             angry_nobel
e41acbad0530   php:8.2-cli   "docker-php-entrypoi…"   4 weeks ago   Exited (1) 4 weeks ago             modest_bardeen
6c56592f3d5c   php:8.2-cli   "docker-php-entrypoi…"   4 weeks ago   Exited (0) 4 weeks ago             eager_chatelet
```

#### docker logs получает логи из контейнера.
#### docker inspect  показывает всю информацию о контейнере.

##### Переменные окружения

```
docker inspect --format '{{range .Config.Env}}{{println .}}{{end}}' my-app
TZ=Europe/Moscow
PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin
...
PHP_INI_DIR=/usr/local/etc/php
```

#### docker port показывает открытый порт контейнера.
#### docker stats показывает статистику использования ресурсов контейнеров.
#### docker diff показывает измененные файлы в файловой системе контейнера.

### Информация о сетях
* docker network ls показывает список сетей
* docker network inspect xxx показывает подробную информацию о сети xxx

### Управление процессами в контейнерах

Перезапуск основного процесса (ID=1) в контейнере (например, PHP-FPM)
```bash
docker exec -it <mycontainer> kill -USR2 1
```

### Автоматический запуск контейнеров

В каталог /etc/systemd/system разместить файл сервиса docker-compose-my-app.service
```
[Unit]
Description=Docker Compose Application Service
Requires=docker.service
After=docker.service

[Service]
WorkingDirectory=/home/bitrix/my-app
ExecStart=/usr/bin/docker-compose -f /home/bitrix/my-app/docker-compose.yml up
ExecStop=/usr/bin/docker-compose -f /home/bitrix/my-app/docker-compose.yml down
TimeoutStartSec=0
Restart=on-failure
StartLimitInterval=60
StartLimitBurst=3

[Install]
WantedBy=multi-user.target
```

## Добавление русской локали
https://ru.stackoverflow.com/a/949930
```
FROM php:7.2-apache
RUN apt-get update && apt-get install -y locales

# Locale
RUN sed -i -e \
  's/# ru_RU.UTF-8 UTF-8/ru_RU.UTF-8 UTF-8/' /etc/locale.gen \
   && locale-gen

ENV LANG ru_RU.UTF-8
ENV LANGUAGE ru_RU:ru
ENV LC_LANG ru_RU.UTF-8
ENV LC_ALL ru_RU.UTF-8
```

## Межконтейнерное взаимодействие

### Подключение к хостовой сети
docker run -it --net=host alpine ip addr show

### Подключение к хостовому пространству процессов
docker run -it --pid=host alpine ps aux

### Запуск другого контейнера в сети другого

```shell
docker run --net=container:http benhall/curl curl -s localhost
```

### Запуск процесса одного контейнера в пространстве процессов другого.

```shell
docker run --pid=container:http alpine ps aux
```

```
sudo systemctl restart docker
```

Так можно подключить strace к процессу внутри контейнера

## Добавление зеркал реестров

Рецепт [отсюда](https://artydev.ru/posts/docker/)

```shell
cat << EOF | sudo tee -a /etc/docker/daemon.json
{ "registry-mirrors" : [ "https://dockerhub.timeweb.cloud", "https://huecker.io", "https://mirror.gcr.io", "https://c.163.com", "https://registry.docker-cn.com", "https://daocloud.io" ] }
EOF
```


## Ресурсы

1. [Создание вашего первого PHP-приложения с помощью Docker](https://leanpub.com/first-php-docker-application-ru)
2. Настройка Cron и Systemd в контейнерах
  * [How to run a cron job inside a docker container](https://stackoverflow.com/questions/37458287/how-to-run-a-cron-job-inside-a-docker-container)
