# Агенты

## Типы агентов
Периодические:
 - повторяющиеся
 - IS_PERIOD=Y
 - Периодичность выполнения: точно в указанное время
 - Назначенное время следующего запуска = Старое назначенное время агента + интервал
 - Подходит для ежедневного запуска

Непериодические:
- неповторяющиеся
- IS_PERIOD=N
- Периодичность выполнения: через заданный интервал
- Назначенное время следующего запуска = Время завершения последнего запуска агента + интервал


## Константы

### BX_CRONTAB

Если данная константа инициализирована значением "true", то функция проверки агентов на запуск будет отбирать только повторяющиеся агенты (IS_PERIOD=Y).

Пример:
```php
define("BX_CRONTAB", true);
```

## Выполнение всех агентов на Cron

- Для начала полностью отключим выполнение агентов на хите. Для этого необходимо выполнить команду в php-консоли административного меню продукта «1С-Битрикс» /bitrix/admin/php_command_line.php?lang=ru:

```php
COption::SetOptionString("main", "agents_use_crontab", "N"); 
echo COption::GetOptionString("main", "agents_use_crontab", "N"); 

COption::SetOptionString("main", "check_agents", "N"); 
echo COption::GetOptionString("main", "check_agents", "Y");
```

В результате выполнения должно быть NN.

- Убираем из файла /bitrix/php_interface/dbconn.php определение следующих констант:

```php
define("BX_CRONTAB_SUPPORT", true);
define("BX_CRONTAB", true);
```

- И добавляем:

```php
if(!(defined("CHK_EVENT") && CHK_EVENT===true))
define("BX_CRONTAB_SUPPORT", true);
```

- Далее создаем файл проверки агентов и рассылки системных сообщений /bitrix/php_interface/cron_events.php:

```php
<?php
$_SERVER["DOCUMENT_ROOT"] = realpath(dirname(__FILE__)."/../..");
$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];

define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS",true); 
define('CHK_EVENT', true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

@set_time_limit(0);
@ignore_user_abort(true);

CAgent::CheckAgents();
define("BX_CRONTAB_SUPPORT", true);
define("BX_CRONTAB", true);
CEvent::CheckEvents();
?>
```

- И добавляем данный скрипт в Cron:
*/5 * * * * /usr/bin/php -f /home/bitrix/www/bitrix/php_interface/cron_events.php

После этого все агенты и отправка системных событий будут обрабатывается из-под cron, раз в 5 минут.

## Отладка агентов


```shell
export PHP_IDE_CONFIG="serverName=example.com" && php \
-dxdebug.mode=debug \
-dxdebug.client_host=192.168.88.96 \
-dxdebug.client_port=9003 \
-dxdebug.start_with_request=yes \
/var/www/html/bitrix/php_interface/cron_events.php
```


## Ссылки
* [Агенты и их использование](https://dev.1c-bitrix.ru/learning/course/?COURSE_ID=43&CHAPTER_ID=03436&LESSON_PATH=3913.3516.3436)
* [Выполнение всех агентов на Cron](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=37&LESSON_ID=5507)