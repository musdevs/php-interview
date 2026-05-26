# Power

## Потребление энергии с отключенным зарядным устройством в Ваттах

```shell
$ cat /sys/class/power_supply/BAT0/power_now | awk '{printf "%.2f Вт\n", $1 / 1000000}'
60.44 Вт
```
