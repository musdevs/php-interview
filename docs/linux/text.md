# Работа с текстом

## less

### Поиск в less без учета регистра

```shell
less -iI text.txt
```

## sed

### Конвертирование адресов email в CSV

```shell
echo 'Иван Иванов <ivan@ex.com>, Петр Петров <petr@ex.com>, "Сидор Сидоров" <sidor@ex.com>, simple@ex.com' | \
sed 's/, /\n/g' | \
sed -E 's/^"?([^"]*?)"? <(.*)>$/\1,\2/; s/^([^,]+)$/,\1/'
```
