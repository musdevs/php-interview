# Пользователи в Битрикс

## Сброс пароля

В начало файла bitrix/.access.php временно добавить

```php
return;
```

Добавить файл bitrix/admin/pc.php и выполнить его через браузер

```php
<?
// bitrix/admin/pc.php
require($_SERVER['DOCUMENT_ROOT']."/bitrix/header.php");
echo $USER->Update(1,array("PASSWORD"=>'Bitrix*123456'));
echo $USER->LAST_ERROR;
require($_SERVER['DOCUMENT_ROOT']."/bitrix/footer.php");
?>
```

Удалить из файла bitrix/.access.php ранее добавленную строку:

```php
return;
```

## Вход на сайт с закрытым публичным доступом

https://dev.1c-bitrix.ru/support/forum/forum6/topic94911/

Добавить файл bitrix/admin/aa.php и выполнить его через браузер
```php
<?
// bitrix/admin/aa.php
define("SM_SAFE_MODE", true);
define("NOT_CHECK_PERMISSIONS",true);
include($_SERVER["DOCUMENT_ROOT"].'/bitrix/modules/main/include/prolog_before.php');
global $USER;
$USER->Authorize(1);
LocalRedirect('/bitrix/admin/');
?>
```
