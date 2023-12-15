# Виртуальная машина BitrixVM

## Установка

[Скачать «1C-Битрикс: Виртуальная машина VMBitrix»](https://www.1c-bitrix.ru/download/vmbitrix.php)

## FAQ

### Как узнать версию BitrixVM

```shell
yum list installed | grep bitrix-env
bitrix-env.noarch       7.3-4.el7       @bitrix
```

### Какие порты должны быть открыты на сервере

Обычный набор портов на машине такой:
 * 22 - ssh
 * 80 / 443 - http/https web сервер
 * 8890 / 8891 - http/https ntlm
 * 8893 / 8894 - http/https сервер мгновенных сообщений
 * 5222 / 5223 - http/https xmpp сервер

[Виртуальная машина BitrixVM v7.x](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=37&INDEX=Y)
