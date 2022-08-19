# Nginx

## Логи

### Добавить в лог идентификатор запроса

Это переменная $request_id

```
http {
    log_format  main  '$remote_addr - $remote_user [$time_local] "$request" $request_id'
                      '$status $body_bytes_sent "$http_referer" '
                      '"$http_user_agent" "$http_x_forwarded_for"';
}
```

В результате лог будет добавлен $request_id=ec7dd7c89f514bce4cdb387b86c0ef9b400:

```
10.0.2.100 - - [19/Aug/2022:15:48:52 +0300] "POST /some/method HTTP/1.0" ec7dd7c89f514bce4cdb387b86c0ef9b400 345 "http://localhost/login" "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Safari/537.36" "-"
```

### Добавить в лог тело запроса

Переменная $request_body

```
http {
    log_format  main  '$remote_addr - $remote_user [$time_local] "$request" $request_id'
                      '$status $body_bytes_sent "$http_referer" '
                      '"$http_user_agent" "$http_x_forwarded_for" "$request_body"';
}
```

```
10.0.2.100 - - [19/Aug/2022:17:52:07 +0300] "POST/some/metho HTTP/1.0" 7b98db02917f6f86bf97b3f8f754e93b200 360 "http://localhost/login" "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHT
ML, like Gecko) Chrome/104.0.0.0 Safari/537.36" "-" "{\x22phone\x22:\x2271234567890\x22,\x22code\x22:\x2212345\x22}"
```

```json
{
    "phone": "71234567890",
    "code": "12345"
}
```
