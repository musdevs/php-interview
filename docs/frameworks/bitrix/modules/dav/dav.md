# DAV

## Документация

### Синхронизация для всех (нужна учетка с правами ко всем учеткам)
[DAV (КП). Настройки модуля](https://dev.1c-bitrix.ru/user_help/settings/dav/settings.php)
[Администратор сервиса Битрикс24 (коробочная версия) - Настройка модуля DAV](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=48&LESSON_ID=2808&LESSON_PATH=3918.4635.4769.2808)

### Синхронизация для одного (нужен локально установленный Outlook)
[Синхронизация календарей в Битрикс24](https://helpdesk.bitrix24.ru/open/11828176)

## Диагностика

Если в local/php_interface/init.php добавить:

define("GW_DEBUG", true); // Debug
define("DAV_EXCH_DEBUG", true);

То можно посмотреть лог синхронизации:

echo shell_exec('cat ' . $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/dav.log");

В таком виде:

```
2025-08-26 16:34:48 SYNCE   Starting EXCHANGE sync...
2025-08-26 16:34:48 SYNCE   Processing user [221] IvanovVV
2025-08-26 16:34:58 SYNCE   ERROR: [110] Connection timed out, [110] Connection timed out
2025-08-26 16:34:58 SYNCE   EXCHANGE sync finished
```
