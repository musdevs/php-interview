# ACPI


```shell script
grep enabled /sys/firmware/acpi/interrupts/gpe*
```

## Отключить

```shell script
echo "disable" > /sys/firmware/acpi/interrupts/gpe13
```