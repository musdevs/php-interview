# Производительность в MySQL

Включить журналирование медленных запросов

```mysql
SET GLOBAL slow_query_log = 'OFF';
```

Отключить журналирование медленных запросов

```mysql
SET GLOBAL slow_query_log = 'OFF';
```

Вывести настройки:

```mysql
SHOW GLOBAL VARIABLES LIKE 'slow\_%';
+-----------------------------------+-----------------------------------------+
| Variable_name                     | Value                                   |
+-----------------------------------+-----------------------------------------+
| slow_launch_time                  | 2                                       |
| slow_query_log                    | OFF                                     |
| slow_query_log_always_write_time  | 10.000000                               |
| slow_query_log_file               | /var/lib/mysql/myserver-slow.log |
| slow_query_log_use_global_control |                                         |
+-----------------------------------+-----------------------------------------+
```

## Ссылки

* [Enable MySQL’s slow query log without a restart](https://ma.ttias.be/mysql-slow-query-log-without-restart/)
