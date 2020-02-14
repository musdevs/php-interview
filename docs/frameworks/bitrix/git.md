# Настройка Git репозитория для Битрикс

## Типичный .gitignore

```
/.idea
!/.gitignore
/.htaccess
/*.sql
/*.txt
/*.dt
/*.tar.gz
/*.gz
/*.tar
/*.bak
/*.old

/bitrix/backup
/bitrix/cache
/bitrix/managed_cache
/bitrix/stack_cache
/bitrix/tmp

!/robots.txt
/sitemap*.xml
/urlrewrite.php
/upload

/bitrix/php_interface/dbconn.php
/bitrix/.settings.php
/bitrix/.settings_extra.php

/bitrix/modules/updater.log
/bitrix/modules/updater_partner.log
/bitrix/site_checker_*.log
```

## Инициализация репозитория во внешнем каталоге

```bash
mkdir /opt/my/bitrix24/gitrepo
git --git-dir=/opt/my/bitrix24/gitrepo --work-tree=/home/bitrix/www init
```

Чтобы каждый раз не указывать каталог --git-dir можно сделать:
```bash
echo "gitdir: /opt/my/bitrix24/gitrepo" > .git
```

Команды:
```bash
git --git-dir=/opt/my/bitrix24/gitrepo --work-tree=/home/bitrix/www add .
git --git-dir=/opt/my/bitrix24/gitrepo --work-tree=/home/bitrix/www commit
git --git-dir=/opt/my/bitrix24/gitrepo --work-tree=/home/bitrix/www remote add origin https://gitlab.example.com/web/bitrix24.git
git --git-dir=/opt/my/bitrix24/gitrepo --work-tree=/home/bitrix/www push -u origin --all
```

## Ресурсы

1. [Как я обычно настраиваю Git репозиторий для работы с 1С-Битрикс](https://dev.1c-bitrix.ru/community/webdev/user/30123/blog/11058/)
