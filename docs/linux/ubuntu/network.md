# Ubuntu networking

## Сброс DNS

[How to Flush Your DNS Cache in Ubuntu](https://www.howtogeek.com/how-to-flush-dns-cache-in-ubuntu/)

Проверить статус демона

```shell
systemctl is-active systemd-resolved
active
```

Статистика DNS

```shell
$ sudo resolvectl statistics
Transactions
                       Current Transactions:     0
                         Total Transactions: 24730

Cache
                         Current Cache Size:   121  <---- кеш ДНС
                                 Cache Hits:   509
                               Cache Misses:  3084

Failure Transactions
                             Total Timeouts:    21
         Total Timeouts (Stale Data Served):     0
                    Total Failure Responses:     0
Total Failure Responses (Stale Data Served):     0

DNSSEC Verdicts
                                     Secure:     0
                                   Insecure:     0
                                      Bogus:     0
                              Indeterminate:     0

```

Сброс DNS

```shell
resolvectl flush-caches
```
