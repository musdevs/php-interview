# VPN

## Проблемы

### f5vpn не подключается

Останавливаем все контейнеры удаляем все сети:

```
docker network prune
```

Перезапускаем сеть

```
sudo systemctl restart NetworkManager
```
