# SSL

##

CA - Certification authority - центр сертификации или удостоверяющий центр. Его открытый ключ широко известен. Его задача - подтверждать подлинность ключей шифрования с помощью сертификатов

## Cheatsheet

### Вывести информацию о сертификате в файле:

```shell
openssl x509 -text -noout -in /etc/nginx/certs/default/default.crt
```

openssl pkcs12 -export -out marketPlace.p12 -in marketPlaceCert.pem -inkey marketPlaceKey.pem

openssl rsa -in ./marketPlaceKey.pem -check

openssl x509 -text -noout -in  marketPlaceCert.pem

openssl x509 -text -noout -in  marketPlaceKey.pem


### Создать PKCS#12 файл

openssl pkcs12 -export -in mycert.pem -out mycert.p12 -name "MyCert"

openssl pkcs12 -in aaaristarkhov@sber.ru.p12 -out sberid_all_test.pem -clcerts -nodes

openssl pkcs12 -in aaaristarkhov@sber.ru.p12 -out sberid_crt_test.pem -clcerts -nokeys

openssl pkcs12 -in aaaristarkhov@sber.ru.p12 -out sberid_key_test.pem -nocerts -nodes

### Извлечь из PEM-файла

#### Инофрмация о PEM-файле

```
openssl x509 -text -noout -in cert.pem
```

#### Извлечь ключ
```
openssl rsa -in cert.pem -out cert.key
```

#### Извлечь сертификат

```
openssl x509 -in cert.pem -out cert.key -clcerts -nokeys
```

### Конвертировать PFX в PEM

Конвертировать PFX в PEM без сохранения пароля:

```
openssl pkcs12 -in 'cert.pfx' -out cert.pem -legacy -noenc
```

## Получить SSL-сертификат без доступа к SSH сервера

[Certbot Instructions](https://certbot.eff.org/instructions?ws=other&os=snap)

### Установить certbot

```shell
sudo snap install --classic certbot
sudo ln -s /snap/bin/certbot /usr/bin/certbot
```

### Запустить выпуск

Если локально занят порт 80, то освободить порт и выполнить:

```shell
sudo certbot certonly --standalone
Saving debug log to /var/log/letsencrypt/letsencrypt.log
Enter email address or hit Enter to skip.
 (Enter 'c' to cancel):

- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
Please read the Terms of Service at:
https://letsencrypt.org/documents/LE-SA-v1.5-February-24-2025.pdf
You must agree in order to register with the ACME server. Do you agree?
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
(Y)es/(N)o: Y
Account registered.
Please enter the domain name(s) you would like on your certificate (comma and/or
space separated) (Enter 'c' to cancel): example.com
Requesting a certificate for example.com

- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
Could not bind TCP port 80 because it is already in use by another process on
this system (such as a web server). Please stop the program in question and then
try again.
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
(R)etry/(C)ancel: R

Successfully received certificate.
Certificate is saved at: /etc/letsencrypt/live/example.com/fullchain.pem
Key is saved at:         /etc/letsencrypt/live/example.com/privkey.pem
This certificate expires on 2025-09-10.
These files will be updated when the certificate renews.
Certbot has set up a scheduled task to automatically renew this certificate in the background.
```

### Подключить

Копировать файл сертификата fullchain.pem и ключа privkey.pem
из /etc/letsencrypt/live/example.com/ в /etc/nginx/ssl.

И добавить в секцию server конфига nginx:

```
server {
    listen 443 ssl;
    ssl_certificate /etc/nginx/ssl/fullchain.pem;
    ssl_certificate_key /etc/nginx/ssl/privkey.pem;
}
```
