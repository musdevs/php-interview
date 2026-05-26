# grep

## Игнорировть регистр символов

```shell
grep -i warning error.log
```

## Искать слово целиком

```shell
grep -w ERORR error.log
```

## Количество вхождений

```shell
grep -с INFO error.log
```

## Выбрать все версии пакетов во всех composer.lock
```shell
find ~/www -name composer.lock -exec grep --with-filename -A 1 \"name\"\:\ \"psr\/container\" {} \;
/home/bitrix/www/bitrix/modules/some/composer.lock:            "name": "psr/container",
/home/bitrix/www/bitrix/modules/some/composer.lock-            "version": "1.0.0",
```

## Найти и показать строки рядом

-A1 - 1 строка перед
-B2 - 2 строки после
-C3 - 3 строки до и после

```shell
grep -iI -C1 passw /var/www/html/bx-site/bitrix/.settings.php
```
