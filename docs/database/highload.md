# Масштабирование

## Репликкация

Данные с одного сервера БД постоянно копируются на другой.

### Репликация Master-Slave

Master - чтение, запись
Slave - только чтение, но с задержкой. М.б. несколько Slave

Можно использовать для масштабирования, но чаще для резервирования

### Репликация Master-Master

На обоих Master - чтение, запись

Master-Master репликацию только в крайнем случае, т.к. в случае сбоев восстановление очень сложное

### Ручная репликация

При записи данных, все запросы будут отправляться на несколько серверов. Зато операции чтения можно будет отправлять на любой сервер.

## Шардинг

### Вертикальный шардинг

Разделение таблиц по разным серверам (шардам). Наиболее крупные и нагруженные таблицы, связанные между собой логически, переносят на отдельную шарду.

### Горизонтальный шардинг

Большая таблица разбивается на несколько частей. Каждая часть таблицы помещается на отдельный сервер.

Разбивать можно:
 - по ID (остаток от деления на кол-во шард)
 - случайный выбор шарды, но нужно создать доп. таблицу, в которую сохранять где хранится новая запись

## Партицирование

Разделение одной таблицы на разные логические группы внутри одного сервера.

Подходит когда большинство операций происходит только с новыми операциями.

## Ссылки

- [Репликация данных](https://highload.today/replikatsiya-dannykh/)
- [Вертикальный шардинг](https://highload.today/vertikalniy-sharding/)
- [Горизонтальный шардинг](https://highload.today/gorizontalniy-sharding/)