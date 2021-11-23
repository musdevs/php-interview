# Пользовательские поля

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
	buf.ENTITY_ID = 'CRM_COMPANY'
	AND bufl.LANGUAGE_ID = 'ru'
	AND bufl.EDIT_FORM_LABEL LIKE '%филиал%'
ORDER BY ID
```
