# Network diagnostic in Linux

Вывести IP-адреса хоста
```bash
hostname --all-ip-addresses
```

Проверить маршрут до хоста
```bash
ip route get 192.168.1.1
```

Список TCP-сокетов (-t), ожидающих соединения (-l), порты выведены числами (-n)
```bash
ss -ltn
```

Подключиться к порту
```bash
telnet 192.168.1.1 9000
```


## Ресурсы

1. [10 examples of Linux ss command to monitor network connections](https://www.binarytides.com/linux-ss-command/)
2. [Первое знакомство с командой ss](https://habr.com/ru/company/ruvds/blog/346744/)