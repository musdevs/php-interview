# Работа с JSON-полями в БД

```php
		$rows = EntityItemTable::getList([
			'select' => [
				'DATA',
				'ENTITY_ID_JSON'
			],
			'runtime' => [
				new ExpressionField(
					'ENTITY_ID_JSON',
					"DATA->>'$.ENTITY_ID'", // ->> сразу возвращает строку без кавычек
					['DATA']
				)
			],
			'filter' => [
				'%ENTITY_ID_JSON'  => 'DEAL_STAGE',
			],
		])->fetchAll();
```

```php
		$rows = EntityItemTable::getList([
			'select' => [
				'DATA',
				'ENTITY_ID_JSON'
			],
			'runtime' => [
				new ExpressionField(
					'ENTITY_ID_JSON',
					"JSON_EXTRACT(%s, '$.ENTITY_ID')", // значение с двойными кавычками
					['DATA']
				)
			],
			'filter' => [
				'%ENTITY_ID_JSON'  => 'DEAL_STAGE',
			],
		])->fetchAll();
```


