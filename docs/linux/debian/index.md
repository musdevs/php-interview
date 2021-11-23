# Debian

## Установка пакетов

Список установленных пакетов
```bash
dpkg-query -l
```

или

```bash
apt list --installed
```

Поиск файла в пакетах

```bash
apt update
apt install apt-file
apt-file update
apt-file search 'vim'
```

Поиск по регулярному выражению

```bash
apt-file search --regexp '/vim$'
```

Установить telnet
```bash
apt-get install telnet
```

Установить route
```bash
apt-get install net-tools
```

Установить ip
```bash
apt-get install iproute2
```

Установить ping
```bash
apt-get install iputils-ping
```

Установить ps
```bash
apt-get install procps
```
