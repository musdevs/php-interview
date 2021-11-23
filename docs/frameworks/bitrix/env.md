# Env

## DEV

### Отключение агентов

Иногода агенты зависают, чтобы их отключить, выполнить:
```php
<?php
define('NO_KEEP_STATISTIC', 'Y');
define('NO_AGENT_STATISTIC', 'Y');
define('NO_AGENT_CHECK', true);
define('PUBLIC_AJAX_MODE', true);
define('DisableEventsCheck', true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

COption::SetOptionString("main", "agents_use_crontab", "N");
echo COption::GetOptionString("main", "agents_use_crontab", "N");

COption::SetOptionString("main", "check_agents", "N");
echo COption::GetOptionString("main", "check_agents", "Y");
```
