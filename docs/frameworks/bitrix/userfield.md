# Пользовательские поля

## Краткое описание полей сущности

```sql
SELECT
	buf.ID,
	buf.FIELD_NAME,
	buf.USER_TYPE_ID,
	buf.MULTIPLE,
	buf.MANDATORY,
	bufl.EDIT_FORM_LABEL,
	CASE
		WHEN buf.USER_TYPE_ID = 'hlblock' THEN CAST(SUBSTRING(buf.SETTINGS, LOCATE('HLBLOCK_ID', buf.SETTINGS)+ 14, 3) AS UNSIGNED)
		ELSE NULL
	END as HLBLOCK_ID
FROM
	b_user_field buf
INNER JOIN b_user_field_lang bufl on
	bufl.USER_FIELD_ID = buf.ID
WHERE
	buf.ENTITY_ID = 'HLBLOCK_77'
	AND bufl.LANGUAGE_ID = 'ru'
ORDER BY
	buf.SORT,
	buf.ID
```

## Найти ID поля по наименованию
```sql
SELECT
	buf.ID,
	buf.ENTITY_ID,
	bufl.EDIT_FORM_LABEL,
	bufl.LIST_COLUMN_LABEL,
	bufl.LIST_FILTER_LABEL,
	buf.*,
	bufl.*
FROM
	b_user_field buf
INNER JOIN b_user_field_lang bufl on
	bufl.USER_FIELD_ID = buf.ID
WHERE
  1=1
	AND buf.ENTITY_ID = 'CRM_COMPANY'
	AND bufl.LANGUAGE_ID = 'ru'
	AND bufl.EDIT_FORM_LABEL LIKE '%филиал%'
ORDER BY ID
```

## Скрипты

### Миграция поля во множественное

```php
CModule::IncludeModule('iblock');

$iblockId = 3;
$entityId = 'IBLOCK_'.$iblockId.'_SECTION';

try {
	$sections = CIBlockSection::GetList(
		array('ID' => 'ASC'),
		array(
			'IBLOCK_ID' => $iblockId,
			'!UF_AUDITOR' => false
		),
		false,
		array('ID', 'UF_AUDITOR')
	);

	while ($section = $sections->GetNext()) {
		$sectionId = $section['ID'];
		$oldAuditor = $section['UF_AUDITOR'];

		if (empty($oldAuditor)) {
			continue;
		}

		$auditors = empty($section['UF_AUDITORS']) ? [] : $section['UF_AUDITORS'];

		$result = $GLOBALS['USER_FIELD_MANAGER']->Update($entityId, $sectionId, ['UF_AUDITORS' => [$oldAuditor]]);
		if (!$result) {
			echo "Ошибка миграции ID=${sectionId}";
		}
	}

} catch (Exception $e) {
	echo "Происшла ошибка: " . $e->getMessage();
}
```
