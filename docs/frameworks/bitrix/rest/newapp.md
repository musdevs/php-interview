# Создание нового Приложения24

## Фронтенд на Vue.js

Создать скелет, запустить dev-сервис и проверить

```
vue create myapp24
cd myapp24
npm run serve
```

Создать конфиг-файл и настроить в нем, чтобы не проверялось имя хоста и транслировать все POST-запросы в GET-запросы
```
cat > vue.config.js << EOF
module.exports = {
  devServer: {
    disableHostCheck: true,
    setup(app) {
      app.post('*', (req, res) => {
        res.redirect(req.originalUrl);
      });
    },
  },
};
EOF
```

На прокси добавить сайт с конфигурацией

```
server {
    listen          443 ssl;
    server_name     dev.example.com;

    add_header "X-Content-Type-Options" "nosniff";
#    add_header 'Access-Control-Allow-Origin' '*';
    add_header 'Access-Control-Allow-Headers' '*';
    add_header "Access-Control-Allow-Methods" '*';

    location / {
        #root   /var/www/dev.dexika.ru;
        proxy_pass      http://127.0.0.1:9090;
        proxy_set_header Host $host;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Real-IP $remote_addr;
    }

    error_page  405     =200 $uri;

    ssl_certificate /etc/letsencrypt/live/dev.example.com/fullchain.pem; # managed by Certbot
    ssl_certificate_key /etc/letsencrypt/live/dev.example.com/privkey.pem; # managed by Certbot
}

server {
    if ($host = dev.example.com) {
        return 301 https://$host$request_uri;
    } # managed by Certbot

    listen          80;
    server_name     dev.example.com;
    location / {
        root /var/www/dev.example.com;
    }
}
```

Прокинуть порт 9090 с удаленного сервера на локальный порт разработки 8080

```shell
ssh -R 9090:127.0.0.1:8080 user@example.com
```
