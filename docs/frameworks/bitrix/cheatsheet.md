
```php
// Подключение css, js и jquery
<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/style.css");?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/script.js");?>
<?$APPLICATION->SetHeadString('<meta name="viewport" content="width=device-width, initial-scale=1">');
<?CJSCore::Init(array("jquery"));?>

// Подключение файлов CSS и JS в D7
use Bitrix\Main\Page\Asset;
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/style.css');
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/script.js');
Asset::getInstance()->addString('<meta name="viewport" content="width=device-width, initial-scale=1">');

// Подключение js и css в шаблоне компонента
$this->addExternalJS('/local/js/script.js');
$this->addExternalCss('/local/css/style.css');
```
