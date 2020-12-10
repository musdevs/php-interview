# Настрока сети в Linux

## Содержание

1. [Network diagnostic in Linux](debug.md)
2. [Network manager](network_manager.md)
3. [Маршрутизация](route.md)

## Изменить TTL пакетов

```
$ ping 127.0.0.1
PING 127.0.0.1 (127.0.0.1) 56(84) bytes of data.
64 bytes from 127.0.0.1: icmp_seq=1 ttl=64 time=0.085 ms
```

```
sudo sysctl net.ipv4.ip_default_ttl=65
```

```
$ ping 127.0.0.1
PING 127.0.0.1 (127.0.0.1) 56(84) bytes of data.
64 bytes from 127.0.0.1: icmp_seq=1 ttl=65 time=0.085 ms
```

Активные соединения
```
nmcli conn show --active
```

nmcli con down "OnePlus 6"
sudo sysctl net.ipv4.ip_default_ttl=64
nmcli con up "OnePlus 6"
sudo sysctl net.ipv4.ip_default_ttl=65
