# Redis

## Команды *redis-cli*:

PING - проверить работу
INFO - информация о сервере
FLUSHALL - сбросить все ключи

Выполнить команду в docker-контейнере
```shell
echo 'PING' | podman exec -i my-redis redis-cli
PONG
```

### Cписок БД

```
info keyspace
# Keyspace
db0:keys=2,expires=0,avg_ttl=0
db1:keys=3,expires=0,avg_ttl=0
```

### Выбор БД

Нпчиная с нуля:

```shell
select 0
OK
```

### Список всех ключей

```
KEYS *
```

### Тип ключа

```
TYPE <key>
```

Получить значения ключей в зависимости от типа:
- for "string": get <key>
- for "hash": hgetall <key>
- for "list": lrange <key> 0 -1
- for "set": smembers <key>
- for "zset": zrange <key> 0 -1 withscores

### Примеры

```
> KEYS *
1) "queues:import"

> TYPE queues:import
list

> LRANGE queues:import 0 -1
1) "{\"displayName\":\"SpasiboSB\\\\Infrastructure\\\\Jobs\\\\Admin\\\\Import\\\\ImportScheduler\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"SpasiboSB\\\\Infrastructure\\\\Jobs\\\\Admin\\\\Import\\\\ImportScheduler\",\"command\":\"O:58:\\\"SpasiboSB\\\\Infrastructure\\\\Jobs\\\\Admin\\\\Import\\\\ImportScheduler\\\":8:{s:6:\\\"logger\\\";N;s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";s:6:\\\"import\\\";s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}\"},\"id\":\"qax7y5M5qbTWzjz0O5wcdDgy1zArFagI\",\"attempts\":0}"
2) "{\"displayName\":\"SpasiboSB\\\\Infrastructure\\\\Jobs\\\\Admin\\\\Import\\\\ImportScheduler\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"SpasiboSB\\\\Infrastructure\\\\Jobs\\\\Admin\\\\Import\\\\ImportScheduler\",\"command\":\"O:58:\\\"SpasiboSB\\\\Infrastructure\\\\Jobs\\\\Admin\\\\Import\\\\ImportScheduler\\\":8:{s:6:\\\"logger\\\";N;s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";s:6:\\\"import\\\";s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}\"},\"id\":\"D2fPyGyRymqc7ntVwtmojjBqRvT5oXUw\",\"attempts\":0}"
```

## Ссылки

* [phpRedisAdmin](https://github.com/erikdubbelboer/phpRedisAdmin)
* [Redis-cli commands](https://redis.io/commands)
