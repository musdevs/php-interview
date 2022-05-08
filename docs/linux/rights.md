# Права

Проверить права на файл для пользователя nginx. Здесь нет прав на директорию project

```
sudo -u nginx namei /var/www/site.local/bitrix/1.css
f: /var/www/site.local/bitrix/1.css
d /
d var
d www
l site.local -> /home/user/projects/site/www
d /
d home
d user
projects - Permission denied
```
