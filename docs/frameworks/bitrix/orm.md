# Bitrix ORM

## Фильтр ORM

### IN (EXPR) - @

```php
$result = \Bitrix\Main\UserTable::getList([
    'select' => ['ID'],
    'filter' => ['@ID' => [1]],
])->fetchAll();
```

### NOT IN (EXPR) - !@

```php
$result = \Bitrix\Main\UserTable::getList([
    'select' => ['ID'],
    'filter' => ['!@ID' => [1]],
])->fetchAll();
```

## Ссылки

[ORM в новом ядре](https://hmarketing.ru/blog/bitrix/orm-v-novom-yadre/)
