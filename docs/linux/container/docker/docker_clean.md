# Очистка докера

## Сколько места занимает докер
```shell
$ docker system df
TYPE            TOTAL     ACTIVE    SIZE      RECLAIMABLE
Images          68        51        24.16GB   11.94GB (49%)
Containers      67        1         8.718GB   8.718GB (99%)
Local Volumes   393       3         14.83GB   14.62GB (98%)
Build Cache     1538      0         12.2GB    12.2GB
```

## Мягкая очиска

По умолчанию эта команда удаляет:
- Все остановленные контейнеры.
- Все неиспользуемые сети.
- Все висячие образы (те, у которых нет тега и которые не используются ни одним контейнером).
- Кэш сборки (build cache).

```shell
$ docker system prune
...
Total reclaimed space: 24.15GB
```

## Сколько после очиски

```shell
$ docker system df
TYPE            TOTAL     ACTIVE    SIZE      RECLAIMABLE
Images          62        1         20.86GB   20.65GB (99%)
Containers      1         1         771B      0B (0%)
Local Volumes   393       0         14.83GB   14.83GB (100%)
Build Cache     572       0         0B        0B
```
