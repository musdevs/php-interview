# JSON в MySQL

## Проверка что в JSON-массиве содержится значение

Для строковых значений ***обязательны двойные кавычки**!

```sql
SET @j = '["legalEntity", 1, "2"]';
SELECT JSON_CONTAINS(@j, '"legalEntity"', '$');
SELECT JSON_CONTAINS(@j, '1', '$');
```
