# Бэкапы

## Сделать бэкап из файлов, измененных не раньше 1 суток
```
find ./local/ \( -type f -mtime -1 \) -print0 \
| tar -czf ~/tmp/local.tar.gz --null -T -
```

