# Certbot

## Ручной выпуск сертификата

Запустить выпуск:

```shell
certbot certonly --manual --preferred-challenges dns -d example.com
```
Перейти в панель управления доменом и добавить TXT-запись
для домена _acme-challenge.example.com. со значением, которое сгенерировал бот.

Затем в браузере проверить что эта запись появилась: https://toolbox.googleapps.com/apps/dig/#TXT/_acme-challenge.example.com.
В результате сертификат с ключом будут созданы в каталоге /etc/letsencrypt/live/example.com/

Весь лог выпуска:

```shell
certbot certonly --manual --preferred-challenges dns -d example.com
Saving debug log to /var/log/letsencrypt/letsencrypt.log
Requesting a certificate for example.com

- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
Please deploy a DNS TXT record under the name:

_acme-challenge.example.com.

with the following value:

pgy_qhrMLuD_HfaadwENnueKKv-JtL8oivoR35SochU

Before continuing, verify the TXT record has been deployed. Depending on the DNS
provider, this may take some time, from a few seconds to multiple minutes. You can
check if it has finished deploying with aid of online tools, such as the Google
Admin Toolbox: https://toolbox.googleapps.com/apps/dig/#TXT/_acme-challenge.example.com.
Look for one or more bolded line(s) below the line ';ANSWER'. It should show the
value(s) you've just added.

- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
Press Enter to Continue

Successfully received certificate.
Certificate is saved at: /etc/letsencrypt/live/example.com/fullchain.pem
Key is saved at:         /etc/letsencrypt/live/example.com/privkey.pem
This certificate expires on 2026-04-18.
These files will be updated when the certificate renews.

NEXT STEPS:
- This certificate will not be renewed automatically. Autorenewal of --manual certificates requires the use of an auth
entication hook script (--manual-auth-hook) but one was not provided. To renew this certificate, repeat this same cert
bot command before the certificate's expiry date.

- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
If you like Certbot, please consider supporting our work by:
 * Donating to ISRG / Let's Encrypt:   https://letsencrypt.org/donate
 * Donating to EFF:                    https://eff.org/donate-le
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
```

### Конфиг Nginx

```
server {
    listen       443 ssl;
    server_name  example.com;

    ssl_certificate /etc/letsencrypt/live/example.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/example.com/privkey.pem;

    root   /home/bitrix/example.com/public;

    location / {
        try_files $uri /index.php?$args;
    }

    charset utf-8;

    location ~ \.php$ {
        try_files $uri =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass unix:/var/run/php-fpm/php-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param PATH_INFO $fastcgi_path_info;
        include fastcgi_params;
    }
}
```

## Выпуск сертификата с использованием Nginx

# /etc/nginx/sites-enabled/dev.dexika.conf

server {
    listen          443 ssl;
    server_name     dev.example.com;

    add_header "X-Content-Type-Options" "nosniff";
    add_header 'Access-Control-Allow-Origin' '*';
    add_header 'Access-Control-Allow-Headers' '*';
    add_header "Access-Control-Allow-Methods" '*';

    location / {
        #root   /var/www/dev.example.com;
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

    listen          443 ssl;
    server_name     app.dev.example.com;

    add_header "X-Content-Type-Options" "nosniff";
    add_header 'Access-Control-Allow-Origin' '*';
    add_header 'Access-Control-Allow-Headers' '*';
    add_header "Access-Control-Allow-Methods" '*';

    location / {
        root /var/www/app.dev.example.com;
            proxy_pass      http://127.0.0.1:9091;
            proxy_set_header Host $host;
            proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
            proxy_set_header X-Real-IP $remote_addr;
    }

    error_page  405     =200 $uri;

    ssl_certificate /etc/letsencrypt/live/app.dev.example.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/app.dev.example.com/privkey.pem;
}

# /etc/nginx/sites-enabled/app.dev.dexika.conf

server {
    if ($host = app.dev.example.com) {
        return 301 https://$host$request_uri;
    }

    listen          80;
    server_name     app.dev.example.com;
    location / {
        root    /var/www/app.dev.example.com;
    }
}

certbot certonly --nginx
certbot certificates

