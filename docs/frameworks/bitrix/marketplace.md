# Разработка решений для коробочного Битрикс24

## Тестирование обновлений

### Лог установок модулей

Лог записывается при загрузке модуля в файл /bitrix/modules/updater_partner.log в формате

```
2023-08-20 15:24:41 - LMU01 - LoadModulesUpdates-Step
2023-08-20 15:24:41 -  - exec CUpdateClientPartner::LoadModulesUpdates
2023-08-20 15:24:41 -  - exec CUpdateClientPartner::ParseServerData
2023-08-20 15:24:41 -  - loadFile
2023-08-20 15:24:41 - U - RETURN
2023-08-20 15:24:41 -  - exec CUpdateClientPartner::UnGzipArchive
2023-08-20 15:24:41 -  - TIME UnGzipArchive 0.083 sec
2023-08-20 15:31:43 -  - TIME UpdateStepModules 421.751 sec
```

### Лог обновлений модулей updater.log

Лог записывается в файл /bitrix/modules/updater.log в формате

```
2023-08-18 19:58:43 -  - exec CUpdateClient::GetHTTPPage
2023-08-18 19:58:43 -  - TIME LoadModulesUpdates(request) 0.083 sec
2023-08-18 19:58:43 -  - exec CUpdateClient::ParseServerData
2023-08-18 19:58:43 - STEP - Finish - NOUPDATES
2023-08-18 19:58:43 - STEP - Finish - NOUPDATES
2023-08-19 17:37:13 - CRUPDCF1 - Run updater '/bitrix/updates/update_m1692455833/dexika.corr/updater1.4.1.php': CopyFiles(install/components/dexika, components/dexika)
```

Для записи в лог используется метод CUpdateClientPartner::AddMessage2Log($sText, $sErrorCode = "")

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
4. [Сбор файлов обновления модулей](https://www.webdebug.ru/blog/sbor-faylov-obnovleniya-moduley/)
