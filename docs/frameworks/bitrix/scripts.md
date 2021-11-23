# Скрипты

## Вход на сайт с закрытым публичным доступом

https://dev.1c-bitrix.ru/support/forum/forum6/topic94911/

```
// authorize.php
<?php
define("SM_SAFE_MODE", true);
define("NOT_CHECK_PERMISSIONS",true);
include($_SERVER["DOCUMENT_ROOT"].'/bitrix/modules/main/include/prolog_before.php');
global $USER;
$USER->Authorize(1);
LocalRedirect('/bitrix/admin/');
```
