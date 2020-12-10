# /etc/nginx/sites-enabled/dev.dexika.conf

server {
    listen          443 ssl;
    server_name     dev.dexika.ru;

    add_header "X-Content-Type-Options" "nosniff";
    add_header 'Access-Control-Allow-Origin' '*';
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

    ssl_certificate /etc/letsencrypt/live/dev.dexika.ru/fullchain.pem; # managed by Certbot
    ssl_certificate_key /etc/letsencrypt/live/dev.dexika.ru/privkey.pem; # managed by Certbot
}

server {
    if ($host = dev.dexika.ru) {
        return 301 https://$host$request_uri;
    } # managed by Certbot

    listen          80;
    server_name     dev.dexika.ru;
    location / {
        root /var/www/dev.dexika.ru;
    }
}

    listen          443 ssl;
    server_name     app.dev.dexika.ru;

    add_header "X-Content-Type-Options" "nosniff";
    add_header 'Access-Control-Allow-Origin' '*';
    add_header 'Access-Control-Allow-Headers' '*';
    add_header "Access-Control-Allow-Methods" '*';

    location / {
        root /var/www/app.dev.dexika.ru;
            proxy_pass      http://127.0.0.1:9091;
            proxy_set_header Host $host;
            proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
            proxy_set_header X-Real-IP $remote_addr;
    }

    error_page  405     =200 $uri;

    ssl_certificate /etc/letsencrypt/live/app.dev.dexika.ru/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/app.dev.dexika.ru/privkey.pem;
}

# /etc/nginx/sites-enabled/app.dev.dexika.conf

server {
    if ($host = app.dev.dexika.ru) {
        return 301 https://$host$request_uri;
    }

    listen          80;
    server_name     app.dev.dexika.ru;
    location / {
        root    /var/www/app.dev.dexika.ru;
    }
}

certbot certonly --nginx
certbot certificates



