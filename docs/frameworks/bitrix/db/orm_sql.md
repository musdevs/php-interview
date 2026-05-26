# SQL в ORM

## Конкатенация полей в запросе

```php
UserTable::getList([
		'filter' => [
			'ID' => $needUsers,
		],
		'select' => ['ID', 'FULL_NAME'],
		'runtime' => [
			new Bitrix\Main\Entity\ExpressionField(
				'FULL_NAME',
				"REPLACE(TRIM(CONCAT(%s, ' ', %s, ' ', %s)), '  ', ' ')",
				['LAST_NAME', 'NAME', 'SECOND_NAME']
			),
		],
	]);
```

## Поиск без учета регистра (в PostgreSQL)

```php
$query->where(
  \Bitrix\Main\ORM\Query\Query::expr()->lower('LAST_NAME'),
  'like',
  mb_strtolower($value)
);
```
или по-другому:

```php
$query->where(
  new \Bitrix\Main\ORM\Fields\ExpressionField('LNM', 'LOWER(%s)', 'LAST_NAME'),
  'like',
  mb_strtolower($value)
);
```
