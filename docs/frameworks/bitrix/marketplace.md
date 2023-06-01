# Разработка решений для коробочного Битрикс24

## Тестирование обновлений

### Отладка установки обновления

В файле /bitrix/modules/main/classes/general/update_client_partner.php
установить точку остановки в методе \CUpdateClientPartner::__RunUpdaterScript

### Повторная установка обновления

Понизить версию модуля в файле bitrix/modules/my.module/install/version.php

### Имитация установки обновления

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

## Демо-режим

### Декодирование include.php

```php
$a = array(
  'ZXhwaXJl' . 'X21' . 'lc3' . 'NfY3V' . 'z' . 'dG' . '9tMg==',
);

echo '$ar = array(', PHP_EOL;
foreach($a as $i => $item) {
	echo '  ', $i, ' => \'', base64_decode($item), '\',', PHP_EOL;
}
echo ');', PHP_EOL;
```

## Ресурсы

1. [Создание собственных модулей](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=101&CHAPTER_ID=1014)
2. [Описание маркетплейса](https://marketplace.bitrix24.site/)
3. [Маркетинговые возможности в Приложениях24](https://vendors.bitrix24.ru/doc/ru/rest_marketing.php)
