# MySQL

## Таблицы

### Структура таблицы

```mysql
SHOW TABLE STATUS where name like 'my_table';
```

### Индексы

```mysql
SHOW INDEX IN my_table;
```

### Удалить все таблицы в БД:

```shell
mysql -N -e "\
SELECT concat('DROP TABLE IF EXISTS ', table_schema, '.', table_name, ';') \
  FROM information_schema.tables \
  WHERE table_schema = 'sitemanager';" > /tmp/drop_all_tables.sql

mysql sitemanager < /tmp/drop_all_tables.sql
```

### Изменить кодировку таблицы

```mysql
ALTER TABLE my_table CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
```

## Пользователи

### Запустить клиента mysql, чтобы он не запоминал в истории команды содержащие IDENTIFIED и PASSWORD

```shell script
mysql --histignore="*IDENTIFIED*:*PASSWORD*"
```

### Создать и выделить права

#### Подключение только локально, права на все:

```mysql
CREATE USER 'test'@'127.0.0.1' IDENTIFIED BY '123';
GRANT ALL PRIVILEGES ON `db`.* TO 'test'@'127.0.0.1';
```

#### Подключение со всех адресов, права на заданные таблицы:

```
CREATE USER 'bi'@'%' IDENTIFIED BY '';
GRANT SELECT ON `portal`.`b_tasks` TO 'bi'@'%';
GRANT SELECT ON `portal`.`b_sonet_group` TO 'bi'@'%';
GRANT SELECT ON `portal`.`b_user` TO 'bi'@'%';
GRANT SELECT ON `portal`.`b_tasks_member` TO 'bi'@'%';
GRANT SELECT ON `portal`.`b_tasks_elapsed_time` TO 'bi'@'%';
```

## Разное

### Посмотреть переменные MySQL

```mysql
SHOW VARIABLES LIKE '%sock%';
```
```
+-----------------------------------------+-----------------------------+
| Variable_name                           | Value                       |
+-----------------------------------------+-----------------------------+
| performance_schema_max_socket_classes   | 10                          |
| performance_schema_max_socket_instances | -1                          |
| socket                                  | /var/run/mysqld/mysqld.sock |
+-----------------------------------------+-----------------------------+
3 rows in set (0.01 sec)
```

### Вертикальный формат вывода в шелле MySQL (\G)

```mysql
show variables like '%sock%'\G;
```
```
*************************** 1. row ***************************
Variable_name: performance_schema_max_socket_classes
        Value: 10
*************************** 2. row ***************************
Variable_name: performance_schema_max_socket_instances
        Value: -1
*************************** 3. row ***************************
Variable_name: socket
        Value: /var/run/mysqld/mysqld.sock
3 rows in set (0.01 sec)
```

### Узнать на каком порту работает MySQL

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

### Проверить открыт ли порт 3306

```shell script
nmap -p 3306 10.10.10.100

Starting Nmap 6.40 ( http://nmap.org ) at 2020-12-24 16:05 MSK
Nmap scan report for my.example.com (10.10.10.100)
Host is up (0.00030s latency).
PORT     STATE    SERVICE
3306/tcp filtered mysql
```

STATE=filtered - закрыт фаерволом

### Посмотреть ошибки последней транзакции

```sql
SHOW ENGINE INNODB STATUS
------------------------
LATEST FOREIGN KEY ERROR
------------------------
2025-04-14 11:55:57 0x7b011dee8640 Error in foreign key constraint of table `sitemanager`.`b_learn_answer`:
Create  table `sitemanager`.`b_learn_answer` with foreign key `b_learn_answer_ibfk_1` constraint failed. Referenced table `sitemanager`.`b_learn_question` not found in the data dictionary.------------
```

## Ссылки

1. [MySQL Tuning and Troubleshooting for System Admins](https://www.youtube.com/watch?v=w-z7QCpnZbM)
