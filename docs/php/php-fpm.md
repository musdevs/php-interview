# PHP-FPM

### Перезапуск php-fpm

```bash
ps -ef | grep fpm
kill -USR2 <master_pid>
```