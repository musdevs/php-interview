# Разработка административной панели

## Примеры

### Добавить кнопку с выпадающим меню на странице редактирования пользователя

Документация по [OnAdminContextMenuShow](https://dev.1c-bitrix.ru/api_help/main/events/onadmincontextmenushow.php)
```php
// /local/php_interface/init.php
AddEventHandler('main', 'OnAdminContextMenuShow', function (&$items) {
    if($GLOBALS["APPLICATION"]->GetCurPage(true) == "/bitrix/admin/user_edit.php") {
        $items[] = [
            "TEXT" => "Дополнительно",
            "ICON" => "",
            "TITLE" => "Дополнительные команды",
            "MENU" =>  [
                [
                    "TEXT" => "Команда1",
                    "ICON" => "",
                    "TITLE" => "",
                    "LINK" => "settings.php?lang=" . LANGUAGE_ID
                ],
            ]
        ];
    }
});
```

## Ссылки

* [Разработка заказных элементов административного раздела](https://dev.1c-bitrix.ru/api_help/main/general/admin.section/index.php)
* [Код примера создания списка элементов](https://dev.1c-bitrix.ru/api_help/main/general/admin.section/rubric_admin_ex.php)
* [Выводить данные в админке (CAdminList)](https://know-online.com/post/bitrix-admin-cadminlist)
