
## Настройка .htaccess для битрикса

В .htaccess для битрикса адрес /server-status редиректится на /bitrix/urlrewrite.php.
Для того чтобы редирект не происходил, нужно в начале добавить правило:

```apacheconf
  RewriteRule ^server-status - [L]
```

```apacheconf
Options -Indexes
ErrorDocument 404 /404.php

<IfModule mod_rewrite.c>
  Options +FollowSymLinks
  RewriteEngine On

  # для URL http::/127.0.0.1/server-status завершить работу и не перекидывать на /bitrix/urlrewrite.php
  RewriteRule ^server-status - [L]

  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteCond %{REQUEST_FILENAME} !-l
  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteCond %{REQUEST_FILENAME} !/bitrix/urlrewrite.php$
  RewriteRule ^(.*)$ /bitrix/urlrewrite.php [L]
  RewriteRule .* - [E=REMOTE_USER:%{HTTP:Authorization}]
</IfModule>

<IfModule mod_dir.c>
  DirectoryIndex index.php index.html
</IfModule>

<IfModule mod_expires.c>
  ExpiresActive on
  ExpiresByType image/jpeg "access plus 3 day"
  ExpiresByType image/gif "access plus 3 day"
  ExpiresByType image/png "access plus 3 day"
  ExpiresByType text/css "access plus 3 day"
  ExpiresByType application/javascript "access plus 3 day"
</IfModule>
```

[Apache Module mod_status](https://httpd.apache.org/docs/2.4/mod/mod_status.html)

## Результат /server-status

```shell
docker compose exec httpd curl http://127.0.0.1/server-status?auto
```

```
127.0.0.1
ServerVersion: Apache/2.4.62 (Debian) PHP/8.1.31
ServerMPM: prefork
Server Built: 2024-10-04T15:21:08
CurrentTime: Tuesday, 27-Jan-2026 11:26:58 MSK
RestartTime: Tuesday, 27-Jan-2026 11:22:41 MSK
ParentServerConfigGeneration: 1
ParentServerMPMGeneration: 0
ServerUptimeSeconds: 256
ServerUptime: 4 minutes 16 seconds
Load1: 0.65
Load5: 0.54
Load15: 0.54
Total Accesses: 13
Total kBytes: 89
Total Duration: 11786
CPUUser: 1.92
CPUSystem: .49
CPUChildrenUser: 0
CPUChildrenSystem: 0
CPULoad: .941406
Uptime: 256
ReqPerSec: .0507813
BytesPerSec: 356
BytesPerReq: 7010.46
DurationPerReq: 906.615
BusyWorkers: 2
GracefulWorkers: 0
IdleWorkers: 5
Scoreboard: ___WW__...............................................................................................................................................
```
