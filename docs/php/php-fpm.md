# PHP-FPM

### Перезапуск php-fpm

```bash
ps -ef | grep fpm
kill -USR2 <master_pid>
```

### Перезапуск php-fpm внутри Docker-контейнера

```shell
kill -USR2 1
```

### Перезапуск php-fpm снаружи Docker-контейнера

```shell
docker exec -it <mycontainer> kill -USR2 1
```
