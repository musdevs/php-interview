# Управление пакетами

## Cheat sheet

### Список файлов, установленных пакетом
```
rpm -ql package_name
```

### Определить, в составе какого пакета был установлен файл

```
rpm -qf file_name
```

### Определить, был ли установлен пакет

```
rpm -q package_name
```

### Найти пакеты, содержащие файл

```
dnf provides '*/file_name'
```

### Вывести список всех доступных версий пакета

```
dnf --showduplicates list package_name
```

### Распаковать пакет

```
rpm2cpio package_name.rpm | cpio -idv
```

### Настроить прокси

```
vi /etc/yum.conf
proxy=http://127.0.0.1:3128
proxy_username=username
proxy_password=user_password
```

