# Проксирование HTTPS в Nginx

## Проброс портов

```
ssh -L 10005:10.10.1.1:443 user@server
```

## Конфигурация локального nginx

```
# /etc/nginx/site-enabled/remote.example.com.conf
server {
        listen 443 ssl;
        server_name remote.example.com;

        ssl_certificate         /etc/nginx/ssl/remote.example.com.pem;
        ssl_certificate_key     /etc/nginx/ssl/remote.example.com.pem;

        location / {
                proxy_pass https://127.0.0.1:10005;
                proxy_set_header Host $host;
                proxy_ssl_name $host;

                # for debugging
                proxy_read_timeout 1800;
        }
}
```
## DNS

```
127.0.0.1       remote.example.com
```
