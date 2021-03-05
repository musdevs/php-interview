# Общая информация об операционной системе

Информация об дистрибутиве
```bash
cat /etc/*-release
```

Использование памяти приложениями
```shell script
ps -eo size,pid,user,command --sort -size | awk '{ hr=$1/1024 ; printf("%13.2f Mb ",hr) } { for ( x=4 ; x<=NF ; x++ ) { printf("%s ",$x) } print "" }'
```
