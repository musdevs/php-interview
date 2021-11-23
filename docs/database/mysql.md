# MySQL

## Таблицы

Структура таблицы

```mysql
SHOW TABLE STATUS where name like 'my_table';
```

Индексы

```mysql
SHOW INDEX IN my_table;
```

Информация о таблице

```mysql
SHOW TABLE STATUS where name like 'my_table';
```

Удалить все таблицы в БД:

```shell
mysql -N -e "\
SELECT concat('DROP TABLE IF EXISTS ', table_schema, '.', table_name, ';') \
  FROM information_schema.tables \
  WHERE table_schema = 'sitemanager';" > /tmp/drop_all_tables.sql

mysql sitemanager < /tmp/drop_all_tables.sql
```

## Пользователи

Запустить клиента mysql, чтобы он не запоминал в истории команды содержащие IDENTIFIED и PASSWORD
```shell script
mysql --histignore="*IDENTIFIED*:*PASSWORD*"
```

Создать и выделить права
```mysql
CREATE USER 'test'@'127.0.0.1' IDENTIFIED BY '123';
GRANT ALL PRIVILEGES ON `db`.* TO 'test'@'127.0.0.1';
```

## Разное

Посмотреть переменные MySQL
```mysql
SHOW VARIABLES LIKE '%sock%';
```

Узнать на каком порту работает MySQL

```shell script
mysql -e 'show variables like "port"';
+---------------+-------+
| Variable_name | Value |
+---------------+-------+
| port          | 3306  |
+---------------+-------+
```

или

```shell script
netstat -tlnp | grep mysql
tcp6       0      0 :::3306                 :::*                    LISTEN      11836/mysqld
```

Проверить открыт ли порт 3306

```shell script
nmap -p 3306 10.10.10.100

Starting Nmap 6.40 ( http://nmap.org ) at 2020-12-24 16:05 MSK
Nmap scan report for my.example.com (10.10.10.100)
Host is up (0.00030s latency).
PORT     STATE    SERVICE
3306/tcp filtered mysql
```

STATE=filtered - закрыт фаерволом 

## Ссылки

1. [MySQL Tuning and Troubleshooting for System Admins](https://www.youtube.com/watch?v=w-z7QCpnZbM)