# Администрирование Битрикс

## Резервные копии

### Распаковка многотомной резервной копии 1С-Битрикс

Если частей архива меньше 10, то можно распаковать сразу командой

```shell
$ cat /mnt/backup/site.ru_20170905_083901_full_991920ba.tar.gz* | tar -xzvf - -i
```

А если больше 10, то файлы нужно переименовать, добавив **0**:
site.ru_20170905_083901_full_991920ba.tar.gz.1 в site.ru_20170905_083901_full_991920ba.tar.gz.01

Или автоматически

Это не сработало:
```shell
ls -v ./backup | xargs -L1 -d '\n' readlink -f | cat | tar -xzvf - -i
```

А так сработало
```
ls -v . | xargs -L1 -d '\n' readlink -f | xargs -d $'\n' cat | tar -C ../portal-new-unpack -xzvf - -i
```

##

### [Настройка работы с просмотром и редактирования документов](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=48&LESSON_ID=13066
