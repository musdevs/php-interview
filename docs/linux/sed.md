# Sed

## Cheetsheat

### Значение переменной из .env-файла
VAR=val
```shell
sed -n -e "/VAR/ s/.*\= *//p" .env
val
```
