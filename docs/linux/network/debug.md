# Network diagnostic in Linux

Вывести IP-адреса хоста
```bash
hostname -I
```

Вывести все IP-адреса хоста
```bash
hostname --all-ip-addresses
```

Вывести внешний IP-адреса хоста
```bash
curl ifconfig.co
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

Открытые порты в контейнере:

```shell
sudo nsenter -t PID -n netstat -lnp
```

где PID - id процесса контейнера, найти можно так:

```shell
podman container inspect -f '{{.State.Pid}}' my-container
```

Проверить открыт ли порт
```bash
nc -zvw3 ya.ru 443
Ncat: Version 7.80 ( https://nmap.org/ncat )
Ncat: Connected to 87.250.250.242:443.
Ncat: 0 bytes sent, 0 bytes received in 0.02 seconds.
```

-v, --verbose              Set verbosity level (can be used several times)
-w, --wait <time>          Connect timeout
-z                         Zero-I/O mode, report connection status only


## Ресурсы

1. [10 examples of Linux ss command to monitor network connections](https://www.binarytides.com/linux-ss-command/)
2. [Первое знакомство с командой ss](https://habr.com/ru/company/ruvds/blog/346744/)
