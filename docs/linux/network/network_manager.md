Список соединений
```bash
nmcli con 
```

Изменить название сооединения
```bash
nmcli con mod "Wired connection 1" connection.id my-conn
```

Вывести сохраненный пароль Wi-Fi
```bash
nmcli --show-secrets con show "My wi-fi" | grep 802-11-wireless-security.psk
```

Перезапустить Network Manager
```bash
systemctl restart NetworkManager.service
```

Установить метрику
```bash
nmcli con mod eno1 ipv4.route-metric 100
```

Показать метрику
```bash
nmcli con show eno1 | grep ipv4.route-metric
```
