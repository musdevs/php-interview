# NTLM

- [Настройка NTLM-авторизации](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=37&LESSON_ID=6560)
- [Не хватает настроек ntlm_devbitrix03.xxx.ru.conf](https://dev.1c-bitrix.ru/community/webdev/user/5559120/blog/41934/)

## Отключение NTLM

```php
<?php
// ntlm_off.php
$_SERVER["DOCUMENT_ROOT"] = '/var/www/html';
$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS",true);
define('BX_NO_ACCELERATOR_RESET', true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

if (!CModule::IncludeModule('ldap')) {
    return false;
}

CLdapUtil::UnSetBitrixVMAuthSupport(true);
echo 'Ntlm auth off';

global $USER;
$USER->Authorize(1);
```
