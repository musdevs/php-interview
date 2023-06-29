# Работа с файлами

## Поиск файлов

Список файлов, измененных в течение последних 10 дней
```shell
find . -type f -mtime -10 -ls
2628204   48 -rw-rw-r--   1 user   user      46922 Jul  2 14:30 ./template.php
```

Список файлов, измененных раньше, чем 30 дней назад
```shell
find . -type f -mtime +30 -ls
2234183    4 -rw-rw-r--   1 user   user          7 Jun 16 22:19 ./service.php
```

## Сортировка

По размеру файлов

По убыванию размера (-S)

```
ls -Slh .
total 18G
-rw-r-----. 1 100998 100998  4,1G сен 23  2021 b_counter_data.ibd
-rw-r-----. 1 100998 100998  3,3G апр 27 15:31 b_user_access.ibd
-rw-r-----. 1 100998 100998  2,5G апр 27 15:30 b_rating_user.ibd
```

В обратном порядке (-r)

```
ls -Slhr .
```

По размеру каталогов

```shell
du -h --max-depth=1 . | sort -h
680K	./sys
1,1M	./performance_schema
34M	./mysql
18G	.
18G	./sitemanager
```

## Права

Проверить права на каталог рекурсивно

```shell
namei -l ./tmp
```

### Установить rw-права на все файлы

```shell
find . -type f -exec setfacl -R -m u:username:rw {} \;
```

### Установить rwx-права на все директории

```shell
find . -type d -exec setfacl -R -m u:username:rwx {} \;
```

## Очистка диска

Запись нулей в раздел /dev/sda1:

```shell
dd if=/dev/zero of=/dev/sda1
```

Запись случайных символов:

```shell
dd if=/dev/urandom of=/dev/sda1
```


Список владельцев директорий

```
sudo find . -type d ! -path "./vendor/*" | xargs ls -ldn | awk '{ print $3 " " $4 }' | uniq
```
