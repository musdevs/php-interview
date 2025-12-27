# Модуль Календарь событий

## Узнать рабочий день или нет

```php
Bitrix\Main\Loader::includeModule('crm');
$d = \Bitrix\Main\Type\DateTime::createFromText('09.05.2025');
$result = (new \Bitrix\Crm\Settings\WorkTime())->isWorkDay($d);
var_dump($result);
// bool(false)
```
