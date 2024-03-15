# Общая информация об операционной системе

## Информация о дистрибутиве
```bash
cat /etc/*-release
```

## Процессы

### Использование памяти приложениями

```shell
ps -eo size,pid,user,command --sort -size | awk '{ hr=$1/1024 ; printf("%13.2f Mb ",hr) } { for ( x=4 ; x<=NF ; x++ ) { printf("%s ",$x) } print "" }'
```

### Все процессы с полной строкой запуска

```shell
ps -efww
UID          PID    PPID  C STIME TTY          TIME CMD
root           1       0  0 фев05 ?     00:02:56 /sbin/init splash
root           2       0  0 фев05 ?     00:00:00 [kthreadd]
root           3       2  0 фев05 ?     00:00:00 [rcu_gp]
```

- **-e** - все процессы
- **-f** - полный формат
- **-ww** - полная строка запуска

Процессы в квадратных скобках - процессы ядра. Например, [kthreadd]
