# Базы данных (схемы) MySQL

## Размер БД

```sql
SELECT
  table_schema AS "Database Name",
  ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) AS "Size in (MB)"
FROM information_schema.TABLES
GROUP BY table_schema;
```

| Database Name       | Size in \(MB\) |
|:--------------------|:---------------|
| information\_schema | 0.20           |
| mysql               | 16.70          |
| performance\_schema | 0.00           |
| sitemanager         | 1752.84        |
| sitemanager1        | 3514.58        |
| sys                 | 0.03           |

## Показать БД COLLATE

```sql
SELECT @@character_set_database, @@collation_database;
| @@character\_set\_database | @@collation\_database |
| :--- | :--- |
| utf8mb4 | utf8mb4\_unicode\_ci |
```

```sql
SHOW CREATE DATABASE sitemanager;
+-------------+---------------------------------------------------------------------------------------------------------------------------------------+
| Database    | Create Database                                                                                                                       |
+-------------+---------------------------------------------------------------------------------------------------------------------------------------+
| sitemanager | CREATE DATABASE `sitemanager` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */ |
+-------------+---------------------------------------------------------------------------------------------------------------------------------------+
```

## Изменить БД COLLATE

```sql
ALTER DATABASE sitemanager CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

## Показать TABLE_COLLATION

```sql
SELECT distinct t.TABLE_COLLATION
FROM information_schema.TABLES t
WHERE table_schema = "sitemanager";
```

## Сгенерировать инструкции для конвертирования

```sql
SELECT CONCAT('ALTER TABLE `', table_name, '` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;') AS run_this_sql
FROM information_schema.tables
WHERE table_schema = 'sitemanager'
  AND table_type = 'BASE TABLE'
  AND table_collation = 'utf8mb4_0900_ai_ci';
```
