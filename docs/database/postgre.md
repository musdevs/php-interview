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

Текущая база:
```sql
SELECT current_database()
```

Размер баз данных:
```sql
SELECT
	t1.datname AS db_name,
	pg_size_pretty(pg_database_size(t1.datname)) AS db_size
FROM
	pg_database t1
ORDER BY
	pg_database_size(t1.datname) DESC;
```

Размер таблиц и индексов:
```sql
SELECT
	*,
	pg_size_pretty(total_bytes) AS total ,
	pg_size_pretty(index_bytes) AS INDEX ,
	pg_size_pretty(toast_bytes) AS toast ,
	pg_size_pretty(table_bytes) AS TABLE
	FROM
		(
		SELECT
			*,
			total_bytes-index_bytes-COALESCE(toast_bytes, 0) AS table_bytes
		FROM
			(
			SELECT
				c.oid,
				nspname AS table_schema,
				relname AS TABLE_NAME ,
				c.reltuples AS row_estimate ,
				pg_total_relation_size(c.oid) AS total_bytes ,
				pg_indexes_size(c.oid) AS index_bytes ,
				pg_total_relation_size(reltoastrelid) AS toast_bytes
			FROM
				pg_class c
			LEFT JOIN pg_namespace n ON
				n.oid = c.relnamespace
			WHERE
				relkind = 'r' ) a ) a
	ORDER BY
		total_bytes DESC;
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

Выполнить внешний скрипт в Postgre внутри контейнера

```bash
docker-compose exec -T postgres psql --username=app --dbname=app < ./script.sql
```

Сделать дамп

```bash
docker-compose exec -T postgres pg_dump --user=app --dbname=app > /tmp/dump.sql
```


## Ресурсы

1. [Настройка Docker-контейнера для PostgreSQL на docs.docker.com](https://docs.docker.com/samples/library/postgres/)
2. [romeOz/docker-postgresql](https://github.com/romeOz/docker-postgresql)
3. [Корректная очистка pg_xlog](http://statlib.tpu.ru/?p=2634)
