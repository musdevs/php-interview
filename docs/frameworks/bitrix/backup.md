# Резервные копии Битрикс

## Распаковка многотомной резервной копии 1С-Битрикс

### Если частей архива меньше 10

Если частей архива меньше 10, то можно распаковать сразу командой

```shell
$ cat /mnt/backup/site.ru_20170905_083901_full_991920ba.tar.gz* | tar -xzvf - -i
```

### Если частей архива больше 10

А если больше 10, то файлы нужно переименовать, добавив **0**:
site.ru_20170905_083901_full_991920ba.tar.gz.1 в site.ru_20170905_083901_full_991920ba.tar.gz.01

Или автоматически:

```shell
ls -v . | xargs -L1 -d '\n' readlink -f | xargs -d $'\n' cat | tar -C ../portal-new-unpack -xzvf - -i
```

## Ручной бэкап каталога

```shell
tar -cvzf ~/tmp/bitrix_www.tar.gz \
--exclude="./bitrix/backup" \
--exclude="./bitrix/cache" \
--exclude="./bitrix/managed_cache" \
--exclude="./bitrix/stack_cache" \
--exclude="./bitrix/tmp" \
--exclude="./bitrix/updates" \
--exclude="./upload/iblock" \
--exclude="./upload/resize_cache" \
--exclude="./upload/tmp" \
--exclude="./upload/export_catalog_files" \
--exclude="./upload/catalog*" \
--exclude-from <(find ./upload -size +2M) \
.
```

```shell
mysqldump sitemanager \
--single-transaction --quick --lock-tables=false \
--ignore-table=sitemanager.b_bp_tracking \
--ignore-table=sitemanager.b_search_content \
--ignore-table=sitemanager.b_search_content_text \
--ignore-table=sitemanager.b_search_content_stem \
--ignore-table=sitemanager.b_cache_tag \
--ignore-table=sitemanager.b_user_profile_record \
--ignore-table=sitemanager.b_event_log \
| gzip > db.sql.gz
```
