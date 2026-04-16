# Строки в PHP

## Сравнение русских строк

```php
$oldLocale = setlocale(LC_COLLATE, 0); // Запоминаем текущую локаль
setlocale(LC_COLLATE, 'ru_RU.UTF-8');
$result = strcoll($str1, $str2);
setlocale(LC_COLLATE, $oldLocale); // Восстанавливаем
```
