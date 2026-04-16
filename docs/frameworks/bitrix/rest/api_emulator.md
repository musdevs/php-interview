# Вызов REST-методов из PHP

```php
\Bitrix\Main\Loader::requireModule('crm');
$controller = new \Bitrix\Crm\Controller\Category();
$result = $controller->listAction(1074);
$result = new Bitrix\Main\Engine\Response\AjaxJson($result);
$result = $result->getContent();
$result = json_decode($result, true);
```
