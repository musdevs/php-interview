# Настройка Supervisor

1. Устанавливаем пакет supervisor для операционной системы
```bash
$ systemctl enable supervisord
```

2. Добавляем конфиг в папку /etc/supervisord.d/hello-world.ini 
```
[program:hello-world]
command=/usr/bin/php /var/www/worker.php
user=ubuntu
numprocs=1
startsecs=0
autostart=true
autorestart=true
process_name=%(program_name)s_%(process_num)02d
```

3. Добавляем в автозагрузку

```bash
$ systemctl enable supervisord
```

4. Стартуем описанные в конфиге процессы

```bash
$ systemctl start supervisord
```

5. Проверяем состояние 

```bash
$ supervisorctl status
```

6. Известить Supervisor о появлении новой программы

```bash
supervisorctl reread
```

7. Активируем новые конфигурации

```bash
supervisorctl update
```

8. Помощь по остальным командам

```bash
supervisorctl help
```

## Ссылки

 * [Установка и управление supervisor на сервере ubuntu и debian](https://www.8host.com/blog/ustanovka-i-upravlenie-supervisor-na-servere-ubuntu-i-debian/)