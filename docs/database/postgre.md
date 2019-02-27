# PostgreSQL

## Полезные запросы

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

## Пример docker-контейнера

```yaml
version: "3.1"
services:
  postgres:
    image: postgres:9.5
    restart: always
    container_name: postgres95
    volumes:
      - ./storage:/var/lib/postgresql/data
    ports:
      - "15432:5432"
    env_file: ".env"
    environment:
      - "POSTGRES_DB=${DB_DATABASE}"
      - "POSTGRES_USER=${DB_USERNAME}"
      - "POSTGRES_PASSWORD=${DB_PASSWORD}"
```

## Ресурсы

1. [Настройка Docker-контейнера для PostgreSQL на docs.docker.com](https://docs.docker.com/samples/library/postgres/)
2. [romeOz/docker-postgresql](https://github.com/romeOz/docker-postgresql)