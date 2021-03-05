# Network diagnostic in Linux

Вывести IP-адреса хоста
```bash
hostname --all-ip-addresses
```

Проверить маршрут до хоста
```bash
ip route get 192.168.1.1
```

Вывести домен
```shell script
host 10.10.1.1
1.1.10.10.in-addr.arpa domain name pointer ltrus1capp04.example.com
```

Список TCP-сокетов (-t), ожидающих соединения (-l), порты выведены числами (-n)
```bash
ss -ltnp
```

Или:
```shell script
netstat -nlpt
```
n - сетевые адреса в числовом виде
l - статус LISTEN
p - PID или название процесса
t - протокол tcp

Подключиться к порту
```bash
telnet 192.168.1.1 9000
```


## Ресурсы

1. [10 examples of Linux ss command to monitor network connections](https://www.binarytides.com/linux-ss-command/)
2. [Первое знакомство с командой ss](https://habr.com/ru/company/ruvds/blog/346744/)
