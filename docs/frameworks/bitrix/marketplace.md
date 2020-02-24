# Разработка решений для коробочного Битрикс24

## Тестирование обновлений

Протестировать обновление можно локально. Для этого каталог обновления
нужно разместить на сервере, например, в /upload/tmp/ и выполнить в
административной панели (Командная PHP-строка) следующий код:

```php
$updateDirFrom = $_SERVER['DOCUMENT_ROOT'] . '/upload/tmp/1.0.1';
$path = $updateDirFrom . '/updater.php';
$moduleID = 'mycompany.mymodule';
$strError = '';

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/update_client_partner.php");
\CUpdateClientPartner::__RunUpdaterScript($path, $strError, $updateDirFrom, $moduleID);
```

## Ресурсы

1. [Создание собственных модулей](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=101&CHAPTER_ID=1014)
