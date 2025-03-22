# Swap

На таймвебе столкнулся с тем, что система не могла установить обновления из-за ошибки:

```
# dnf update
Killed
```

[Тут](https://stackoverflow.com/questions/78587883/yum-and-dnf-commands-return-killed-on-centos-9-stream-server) сказали, что из-за маленького свопа

Оказалось, что свопа нет вообще. Тут [инструкция](https://www.digitalocean.com/community/tutorials/how-to-add-swap-on-centos-7), как его добавить

```
# free
               total        used        free      shared  buff/cache   available
Mem:          980200      725708      261696       23320      151316      254492
Swap:              0           0           0
[root@4308267-kr23464 ~]# swap
swaplabel  swapoff    swapon
[root@4308267-kr23464 ~]# swapon -s
[root@4308267-kr23464 ~]# dd if=/dev/zero of=/swapfile count=2048 bs=1MiB
2048+0 records in
2048+0 records out
2147483648 bytes (2.1 GB, 2.0 GiB) copied, 4.89276 s, 439 MB/s
[root@4308267-kr23464 ~]# ls -lh /swapfile
-rw-r--r-- 1 root root 2.0G Feb 24 23:00 /swapfile
[root@4308267-kr23464 ~]# chmod 600 /swapfile
[root@4308267-kr23464 ~]# ls -lh /swapfile
-rw------- 1 root root 2.0G Feb 24 23:00 /swapfile
[root@4308267-kr23464 ~]# mkswap /swapfile
Setting up swapspace version 1, size = 2 GiB (2147479552 bytes)
no label, UUID=35a7d1a6-0562-411b-b5a0-5757c7ca27e7
[root@4308267-kr23464 ~]# swapon /swapfile
[root@4308267-kr23464 ~]# swapon -s
Filename				Type		Size		Used		Priority
/swapfile                               file		2097148		0		-2
[root@4308267-kr23464 ~]# free -m
               total        used        free      shared  buff/cache   available
Mem:             957         731          67          22         319         225
Swap:           2047           0        2047
[root@4308267-kr23464 ~]# nano /etc/fstab
/swapfile   swap    swap    sw  0   0
```

