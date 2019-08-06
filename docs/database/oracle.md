# Oracle

## Полезные запросы

Получить форимат даты для сессии
```sql
SELECT value FROM  nls_session_parameters WHERE  parameter = 'NLS_DATE_FORMAT'
```

Установить формат даты для сессии
```sql
ALTER SESSION SET nls_date_format = 'YYYY-MM-DD HH24:MI:SS'
```

## Ресурсы

[Docker containers for develop on PHP and Oracle](https://github.com/musdevs/docker-php-oracle)