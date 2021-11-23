# Настройка почты в BitrixEnv

## msmtp

Удачный конфиг для яндекс

```
# /home/bitrix/.msmtprc
account default
logfile /home/bitrix/msmtp_default.log
host smtp.yandex.ru
port 587
from user@example.com
aliases /etc/aliases
keepbcc on
auth on
user user@example.com
password *

tls on
tls_starttls on
tls_certcheck off
```
