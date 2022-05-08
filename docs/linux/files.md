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

Проверить права на каталог рекурсивно
```shell
namei -l ./tmp
```
