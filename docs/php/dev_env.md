# Настройка рабочего окружения разработчика

## Отладка PHP-CLI в PhpStorm

1. В PhpStorm нужно установить Debug-порт. Для этого в разделе XDebug
   (File - Settings - Languages & Frameworks - PHP - Debug),
   установить параметр Debug port, например, в 9001.
2. Добавить конфигурацию запуска (Run - Edit Configuration) из шаблона PHP Web Page
3. В конфигурации добавить сервер, например, dev.local и настроить для него соответствие
   локальных директорий и удаленных
3. В консоли добавить переменную окружения XDEBUG_CONFIG
   ```bash
   $ export XDEBUG_CONFIG="remote_autostart=1 remote_host=dev.local"
   ```
4. В консоли добавить переменную окружения XDEBUG_CONFIG
   ```bash
   $ export PHP_IDE_CONFIG=serverName=dev.local
   ```
5. Запустить прослушивание Debug-порта (Run - Start listening for PHP Debug connections)
6. Проверить, что порт прослушивается:
   ```bash
   $ ss -ltn | grep 9001
   LISTEN    0         50                 0.0.0.0:9001             0.0.0.0:*
   ```
7. Подключить журнал XDebug можно ini-параметром xdebug.remote_log = /var/log/xdebug.log

## Ресурсы
1. [PhpStorm + Docker + Xdebug](https://blog.denisbondar.com/post/phpstorm_docker_xdebug)
2. [Как подружить PHPstorm, xDebug и удаленные ветки, собранные через Docker](https://habr.com/ru/post/423337/)
3. [Отладка удаленного xdebug за NAT](http://tokarchuk.ru/2017/07/remote-xdebug-behind-nat/)
4. [Xdebug - Supported Versions and Compatibility](https://xdebug.org/docs/compat#versions)
