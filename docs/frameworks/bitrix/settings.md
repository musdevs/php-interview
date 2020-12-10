# Настройка Битркикс

## Принудительное включение https в ядре

Если не корректно настроен хостинг, то можно принудительно [сказать](https://divasoft.ru/blog/prinuditelnoe-vklyuchenie-https-v-yadre-1s-bitriks/) битриксу, что ядро работает по https. Для этого создаём/редактируем файл bitrix/.settings_extra.php

```php
<?php
return array (
    "https_request" => array("value" => true),
);
 ?>
```
