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

Вывести подробную информацию об IP-адресе
```bash
function ipa {
  curl -s https://ifconfig.co/json?ip=$1 | jq 'del(.user_agent)'
}

ipa 92.53.96.105
{
  "ip": "92.53.96.105",
  "ip_decimal": 1547001961,
  "country": "Russia",
  "country_iso": "RU",
  "country_eu": false,
  "region_name": "St.-Petersburg",
  "region_code": "SPE",
  "zip_code": "195213",
  "city": "St Petersburg",
  "latitude": 59.9417,
  "longitude": 30.3096,
  "time_zone": "Europe/Moscow",
  "asn": "AS9123",
  "asn_org": "TimeWeb Ltd.",
  "hostname": "vh434.timeweb.ru"
}
```

Вывести страну IP-адреса

```shell
function ipc {
  curl -s https://ifconfig.co/json?ip=$1 | jq '.country'
}

ipc 92.53.96.105
"Russia"
```

Проверить маршрут до хоста
```bash
ip route get 192.168.1.1
```

Вывести домен
```shell
host 10.10.1.1
1.1.10.10.in-addr.arpa domain name pointer ltrus1capp04.example.com
```

Список TCP-сокетов (-t), ожидающих соединения (-l), порты выведены числами (-n)
```bash
ss -ltnp
```

Или:
```shell
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
