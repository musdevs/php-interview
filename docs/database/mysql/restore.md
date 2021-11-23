## Восстановление MySQL

## Восстановление сервера полностью

Сделать бекап всех БД

```shell
mysqldump -uroot --all-databases --lock-tables=false | gzip > /home/user/all_dump.sql.gz
```

Если на новом сервере MySQL уже установлен, но все БД нужно удалить, просто удаляем все из каталога

```shell
systemctl stop mysqld
rm -rf /var/lib/mysql/*
```

Запустить сервер и запустить восстановление

```shell
systemctl start mysqld
zcat /home/user/all_dump.sql.gz | mysql -uroot -p
```

Восстановление внутри контейнера с помощью Podman:

```shell
zcat dump.sql.gz | podman exec -i \
test-mysql \
mysql -uuser -psecret mydb
```

[Как устранить неисправность InnoDB в базе данных MySQL](https://kb.justhost.ru/article/1436)
