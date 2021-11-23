# Namespaces

## nsenter

### Процессы внутри контейнера

```shell
sudo nsenter -t 803181 --all ps -ef
UID          PID    PPID  C STIME TTY          TIME CMD
logstash       1       0  6 11:30 ?        00:02:03 /usr/share/logstash/jdk/bin/java -Xms1g -Xmx1g -XX:+UseConcMarkSweepGC -XX:CMSInitiat
logstash      95       0  0 11:31 pts/0    00:00:00 bash
root         100       0  0 12:04 ?        00:00:00 ps -ef
```

## Links

* [Podman: Managing pods and containers in a local container runtime](https://developers.redhat.com/blog/2019/01/15/podman-managing-containers-pods#)
