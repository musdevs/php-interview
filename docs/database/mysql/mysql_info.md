# MySQL Info

## Версия сервера

```shell
mysqld --version
mysqld  Ver 5.7.32-35 for Linux on x86_64 (Percona Server (GPL), Release 35, Revision 5688520)
```

## Размер таблиц

```sql
SELECT
  table_name AS "Table Name",
  ROUND(((data_length + index_length) / 1024 / 1024), 2) AS "Size in (MB)"
FROM information_schema.TABLES
WHERE table_schema = "sitemanager"
ORDER BY (data_length + index_length) DESC;
```

```
+------------------------------------------------+--------------+
| Table Name                                     | Size in (MB) |
+------------------------------------------------+--------------+
| b_bp_tracking                                  |     52888.17 |
| b_search_content                               |     10224.70 |
| b_search_content_text                          |      8644.25 |
| b_search_content_stem                          |      5752.56 |
| b_cache_tag                                    |      5436.75 |
| b_im_message                                   |      1897.13 |
```


