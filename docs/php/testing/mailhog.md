# MailHog

На основе [Отправка почты из Docker. Используем MailHog](https://wp-yoda.com/okruzhenie/otpravka-pochty-iz-docker-ispolzuem-mailhog/)

1. Добавить файл msmtprc

```
# /etc/msmtprc

defaults
port 1025
tls off
logfile /proc/self/fd/2

account default
auth off
host mailhog
from default-mail@docker-lamp.example
add_missing_date_header on
#user on
#password on
```

2. Добавить в Dockerfile

```
FROM php

# Устанаваливаем пакеты msmtp и msmtp-mta
RUN set -xe; \
    apt-get update; \
    apt-get -y install \
      msmtp \
      msmtp-mta

# Копируем msmtprc конфиг
COPY msmtprc /etc/msmtprc
```

msmtp-mta — используется как алиаса sendmail для msmtp.
Это позволяет не возиться с настройками php.ini,
т.к. в php.ini sendmail_path по дефолту будет /usr/sbin/sendmail -t -i

3. В docker-compose.yml

```yaml
  mailhog:
    image: mailhog/mailhog
    ports:
      - "1025"
      - "8025:8025"
```
