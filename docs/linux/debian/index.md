# Debian

## Установка пакетов

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

## Поиск пакетов

### Список установленных пакетов

```bash
dpkg-query -l
```

или

```bash
apt list --installed
```

### Поиск файла в пакетах

```bash
apt update
apt install apt-file
apt-file update
apt-file search 'vim'
```

### Поиск по регулярному выражению

```bash
apt-file search --regexp '/vim$'
```

### Поиск пакета, установившего файл

#### Определить полный путь

```shell
which docker-compose
/usr/bin/docker-compose
```

#### Найти пакет

```shell
apt-file search --regexp "^/usr/bin/docker-compose$"
docker-compose: /usr/bin/docker-compose
```

#### Вывести информацию о пакете

```shell
apt show docker-compose
Package: docker-compose
Version: 1.29.2-1
Priority: optional
Section: universe/admin
Origin: Ubuntu
Maintainer: Ubuntu Developers <ubuntu-devel-discuss@lists.ubuntu.com>
Original-Maintainer: Docker Compose Team <team+docker-compose@tracker.debian.org>
Bugs: https://bugs.launchpad.net/ubuntu/+filebug
Installed-Size: 510 kB
Depends: python3-cached-property (>= 1.2.0) | python3 (>> 3.8), python3-distro (>= 1.5.0), python3-docker (>= 5), python3-dockerpty (>= 0.4.1), python3-docopt (>= 0.6.1), python3-dotenv (>= 0.13.0), python3-jsonschema, python3-requests (>= 2.20.0), python3-texttable (>= 0.9.0), python3-websocket (>= 0.32.0), python3-yaml (>= 3.10), python3:any, python3-distutils
Recommends: docker.io (>= 1.9.0)
Homepage: https://docs.docker.com/compose/
Download-Size: 95,8 kB
APT-Manual-Installed: yes
APT-Sources: http://ru.archive.ubuntu.com/ubuntu jammy/universe amd64 Packages
Description: define and run multi-container Docker applications with YAML
 docker-compose is a service management software built on top of docker. Define
 your services and their relationships in a simple YAML file, and let compose
```
