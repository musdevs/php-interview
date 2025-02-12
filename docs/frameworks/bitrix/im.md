# Веб-мессенджер

## Проблемы

### Нет панели мессенджера

Сразу после новой установки нет панели. Ядро 24.200.100 (2024-10-29 11:50:11) нет панели.
В заголовке шаблона (/bitrix/templates/bitrix24/header.php) проверяется, что фича подключена:

```php
$imBarExists =
	Loader::includeModule('im') &&
	CBXFeatures::IsFeatureEnabled('WebMessenger') &&
	!defined('BX_IM_FULLSCREEN');
```

CBXFeatures::IsFeatureEnabled('WebMessenger') возвращает false

Установка вручную:

```php
CBXFeatures::SetFeatureEnabled("WebMessenger", true, true);
```
