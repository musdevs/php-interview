# Push-сервер

## Установка

### Открыть порт 8895 для МП

Нужно узнать, какой файрвол используется в VMbitrix:

```shell
firewall-cmd --zone=public --list-all
```

Если в результате будет выведен список правил, значит используется firewalld, если ошибка – значит iptables:

```shell
[root@violent-culebra ~]# firewall-cmd --zone=public --list-all
-bash: firewall-cmd: command not found
[root@violent-culebra ~]#
```

Команды для открытия порта 8895:

iptables:
```shell
iptables -A bx_public -p tcp -m state --state NEW -m tcp --dport 8895 -m comment --comment "BX: push public port" -j ACCEPT && iptables-save >> /etc/sysconfig/iptables
```

firewalld:
```shell
firewall-cmd --zone=public --add-port=8895/tcp --permanent && firewall-cmd --reload
```
