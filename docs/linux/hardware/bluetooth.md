## Настройка соединения с Bluetooth-гарнитурой

```
systemctl status bluetooth
```


### Список доступных команд для управления bluetooth

```
bluetoothctl help
```

### Подключение нового устройства
```
$ bluetoothctl
[bluetooth]# scan on
Discovery started
[CHG] Controller 00:10:20:30:40:50 Discovering: yes
...
[NEW] Device 10:20:30:40:50:60 My device
...
[bluetooth]# pair 10:20:30:40:50:60
Attempting to pair with 10:20:30:40:50:60
[CHG] Device 10:20:30:40:50:60 Connected: yes
[CHG] Device 10:20:30:40:50:60 UUIDs: 00002233-0000-0000-0000-0000549e3568
...
[CHG] Device 10:20:30:40:50:60 ServicesResolved: yes
[CHG] Device 10:20:30:40:50:60 Paired: yes
Pairing successful
[CHG] Device 10:20:30:40:50:60 ServicesResolved: no
[CHG] Device 10:20:30:40:50:60 Connected: no
...
[bluetooth]# connect 10:20:30:40:50:60
Attempting to connect to 10:20:30:40:50:60
[CHG] Device 10:20:30:40:50:60 Connected: yes
Connection successful
[CHG] Device 10:20:30:40:50:60 ServicesResolved: yes
...
```

### Список устройств

```
$ bluetoothctl devices
Device 10:20:30:40:50:61 HP-345
Device 10:20:30:40:50:62 Redmi
Device 10:20:30:40:50:60 My device
```

### Подключиться к устройству

```
$ bluetoothctl connect 10:20:30:40:50:60
```

### Отключиться

```
$ bluetoothctl disconnect 10:20:30:40:50:60
```
