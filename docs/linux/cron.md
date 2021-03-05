# Cron

Задача:
Сделать задание, которое бы каждые 5 минут записывало текущее время в файл

1. Создать файл /etc/cron.d/my-cron со следующим содержимым:
```bash
# For details see man 4 crontabs

# Example of job definition:
# .---------------- minute (0 - 59)
# |  .------------- hour (0 - 23)
# |  |  .---------- day of month (1 - 31)
# |  |  |  .------- month (1 - 12) OR jan,feb,mar,apr ...
# |  |  |  |  .---- day of week (0 - 6) (Sunday=0 or 7) OR sun,mon,tue,wed,thu,fri,sat
# |  |  |  |  |
# *  *  *  *  * user-name  command to be executed

*/5 * * * * /bin/date "+\%d.\%m.\%Y \%H:\%M:\%S" >> /var/log/cron.log 2>>/var/log/cron.log
```

2. Добавить задание
```bash
crontab /etc/cron.d/my-cron
```

3. Просмотреть очередь
```bash
crontab -u root -l
```

Просмотреть все очереди всех пользователей
```bash
for user in $(cut -f1 -d: /etc/passwd); do echo $user; crontab -u $user -l; done
```

- [Laravel Scheduler task in the docker container](https://medium.com/@fazlulkabir94/everyday-we-need-to-run-some-task-automatic-in-the-web-server-for-various-purpose-suppose-we-have-f1d6192e63ec)
