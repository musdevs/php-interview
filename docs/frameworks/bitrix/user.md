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

## Авторизация под администратором

В начало файла bitrix/.access.php временно добавить

```php
return;
```

Добавить файл bitrix/admin/aa.php и выполнить его через браузер
```php
<?
// bitrix/admin/aa.php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $USER;
$USER->Authorize(1);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>
```

Удалить из файла bitrix/.access.php ранее добавленную строку:

```php
return;
```
