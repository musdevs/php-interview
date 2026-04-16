# Загрузка файла в пользовательское поле типа файл

```php
\Bitrix\Main\Loader::requireModule('crm');

$dealId = 153;
$fileIdInFileTable = 432;

$factory = Container::getInstance()->getFactory(CCrmOwnerType::Deal);
$item = $factory->getItem($dealId);

\Bitrix\Main\UserField\File\ManualUploadRegistry::getInstance()
	->registerFile(
		[
			'ID' => 422,
			'ENTITY_ID' => 'CRM_DEAL',
			'FIELD_NAME' => 'UF_CRM_1721553363200',
		],
		$fileIdInFileTable
	);

$item->set('UF_CRM_1721553363200', [432]);
$operation = $factory->getUpdateOperation($item);

$result = $operation->launch();
```
