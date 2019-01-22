# PostgreSQL

Список всех таблиц во всех схемах с комментарием:
```sql
SELECT
	st.schemaname, st.relname, pgd.description
FROM
	pg_catalog.pg_statio_all_tables st
LEFT JOIN pg_catalog.pg_description pgd ON
	(pgd.objoid = st.relid)
	AND pgd.objsubid = 0
WHERE
	st.schemaname NOT IN ('information_schema',
	'pg_catalog',
	'pg_toast')
ORDER BY
	st.schemaname,
	st.relname
```

Все роли:
```sql
SELECT * FROM pg_roles;
```

Все базы:
```sql
SELECT * FROM pg_database
```
