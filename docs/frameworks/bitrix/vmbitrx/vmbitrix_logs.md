# Где смотреть логи виртуальной машины Битрикс (VM Bitrix)

## Лог Apache
/var/log/httpd/error_log

## Лог Nginx
/var/log/nginx/error.log

## Лог PHP
/var/log/php/exceptions.log

## Лог почты
Путь к логам почты прописан в /home/bitrix/.msmtprc. По-умолчанию после настройки почты для первого сайта логи пишутся сюда:
/home/bitrix/msmtp_default.log

## bash, cron
/var/spool/mail/root

/var/spool/mail/bitrix

## Лог запущенных задач в BitrixVM
/opt/webdir/temp
