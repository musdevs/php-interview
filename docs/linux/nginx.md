
## Настроить прокси 
Создать файл /etc/nginx/bx/site_enabled/preprod.conf
```
server {
        listen       443 http2;
        server_name  preprod.example.com;

        access_log /var/log/nginx/preprod.access.log;
        error_log /var/log/nginx/preprod.error.log warn;

        location / {
               proxy_pass      https://preprod.example.com;
        }
}
```

## Перечитать конфигурационные файлы
```bash
systemctl reload nginx
```

## Тестирование конфигурационных файлов
```bash
nginx -t
```
