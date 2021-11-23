# iptables

## Открыть порт

ДОБАВИТЬ правило
```
iptables -I INPUT -p tcp --dport 6326 -m state --state NEW -j ACCEPT
```

Но иногда это не сработает. Нужно учитывать последовательность правил, поэтому в некоторых случаях нужно ВСТАВЛЯТЬ правила в нужное место.
```
iptables -A INPUT -p tcp --dport 6326 -m state --state NEW -j ACCEPT
```

Ключ -I вставляет правило (строка 1), а ключ -A добавляет (строка 10). Правило в строке 10 не будет срабатывать, т.к. пакеты будут отклонятся правилом в строке 9.
```
iptables -L -v -n
Chain INPUT (policy ACCEPT 0 packets, 0 bytes)
1   pkts bytes target     prot opt in     out     source               destination
2      2   112 ACCEPT     tcp  --  *      *       0.0.0.0/0            0.0.0.0/0            tcp dpt:6326 state NEW
3   308K   28M bx_trusted  all  --  *      *       0.0.0.0/0            0.0.0.0/0
4   298K   27M bx_public  all  --  *      *       0.0.0.0/0            0.0.0.0/0
5  16779 2443K ACCEPT     all  --  *      *       0.0.0.0/0            0.0.0.0/0            state RELATED,ESTABLISHED
6     10   600 ACCEPT     tcp  --  *      *       0.0.0.0/0            0.0.0.0/0            state NEW tcp dpt:22
7   1003 84204 ACCEPT     icmp --  *      *       0.0.0.0/0            0.0.0.0/0
8  10012 1602K ACCEPT     all  --  lo     *       0.0.0.0/0            0.0.0.0/0
9   270K   22M REJECT     all  --  *      *       0.0.0.0/0            0.0.0.0/0            reject-with icmp-host-prohibited
10     0     0 ACCEPT     tcp  --  *      *       0.0.0.0/0            0.0.0.0/0            tcp dpt:6326 state NEW
```
