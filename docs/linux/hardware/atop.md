# atop

atop - утилита для мониторинга производительности

Показать снимки в интервале 20 минут
```shell
atop -r /var/log/atop/atop_20220330 -b 15:00:00 -e 15:20:00
```

Результат (переход между снимками t (следующий) и T (предыдущий)):

<pre><span style="background-color:#000000"><font color="#FFFFFF">ATOP - stg-back-01                       2022/03/30  15:06:39                       --------------                        614d3h3m50s elapsed</font></span>
PRC | sys   50h53m | user  78h45m | #proc    214 | #trun      1 |  #tslpi   262 | #tslpu     0 | #zombie    0 | clones 646e5 | #exit	  0 |
CPU | sys	1% | user      4% | irq       0% | idle    395% |  wait      0% | <font color="#00AA00">ipc notavail</font> | <font color="#00AA00">cycl unknown</font> | curf 2.39GHz | curscal   ?% |
cpu | sys	0% | user      1% | irq       0% | idle     99% |  cpu003 w  0% | <font color="#00AA00">ipc notavail</font> | <font color="#00AA00">cycl unknown</font> | curf 2.39GHz | curscal   ?% |
cpu | sys	0% | user      1% | irq       0% | idle     99% |  cpu001 w  0% | <font color="#00AA00">ipc notavail</font> | <font color="#00AA00">cycl unknown</font> | curf 2.39GHz | curscal   ?% |
cpu | sys	0% | user      1% | irq       0% | idle     99% |  cpu000 w  0% | <font color="#00AA00">ipc notavail</font> | <font color="#00AA00">cycl unknown</font> | curf 2.39GHz | curscal   ?% |
cpu | sys	0% | user      1% | irq       0% | idle     99% |  cpu002 w  0% | <font color="#00AA00">ipc notavail</font> | <font color="#00AA00">cycl unknown</font> | curf 2.39GHz | curscal   ?% |
CPL | avg1    0.21 | avg5    0.17 | avg15   0.14 |              |  csw 330524e5 |              | intr 10636e6 |              | numcpu     4 |
MEM | tot     3.7G | free  799.2M | cache 577.3M | buff    0.0M |  slab    1.1G | shmem 171.3M | vmbal   0.0M | hptot   0.0M | hpuse   0.0M |
SWP | tot     2.0G | free    1.2G |              |              |               |              |              | vmcom   2.9G | vmlim   3.8G |
PAG | scan 10868e4 | steal 6496e4 | stall  29685 |              |               |              |              | swin 11899e3 | swout 1749e4 |
LVM |  centos-root | busy      0% | read 8474385 | write 9561e4 |  KiB/r     21 | KiB/w     19 | MBr/s    0.0 | MBw/s    0.0 | avio 0.19 ms |
LVM |  centos-swap | busy      0% | read 11900e3 | write 1749e4 |  KiB/r      4 | KiB/w      4 | MBr/s    0.0 | MBw/s    0.0 | avio 0.06 ms |
LVM |  centos-zero | busy      0% | read      27 | write      0 |  KiB/r      4 | KiB/w      0 | MBr/s    0.0 | MBw/s    0.0 | avio 0.26 ms |
DSK |          sda | busy      0% | read 12767e3 | write 8991e4 |  KiB/r     17 | KiB/w     21 | MBr/s    0.0 | MBw/s    0.0 | avio 0.21 ms |
DSK |          sdb | busy      0% | read      92 | write      0 |  KiB/r     28 | KiB/w      0 | MBr/s    0.0 | MBw/s    0.0 | avio 0.04 ms |
NET | transport    | tcpi 63107e5 | tcpo 72290e5 | udpi 7617997 |  udpo 24774e3 | tcpao 1621e5 | tcppo 2786e4 | tcprs 1025e3 | udpie	  0 |
NET | network	   | ipi 635277e4 | ipo 641644e4 | ipfrw      0 |  deliv 6353e6 |              |              | icmpi 1737e4 | icmpo     44 |
NET | ens224    0% | pcki 34273e5 | pcko 19717e5 | sp   10 Gbps |  si  720 Kbps | so  263 Kbps | erri       0 | erro	   0 | drpo	  0 |
NET | ens192    0% | pcki 23565e4 | pcko 22341e4 | sp   10 Gbps |  si  101 Kbps | so   61 Kbps | erri       0 | erro	   0 | drpo	  0 |
NET | lo      ---- | pcki 42324e5 | pcko 42324e5 | sp    0 Mbps |  si 1126 Kbps | so 1126 Kbps | erri       0 | erro	   0 | drpo	  0 |
<font color="#00AA00">                                                </font><blink><font color="#00AA00">*** system and process activity since boot ***</font></blink>
<span style="background-color:#000000"><font color="#FFFFFF">  PID   SYSCPU   USRCPU     VGROW    RGROW    RDDSK     WRDSK   RUID        EUID       ST   EXC     THR   S    CPUNR    CPU   CMD        1/10</font></span>
27971   18h03m    3h06m    52252K    2364K   212.8M        0K   haproxy     haproxy    N-     -       1   S        2     0%   haproxy
 1126    4h45m    7h34m    265.4M    2208K   561.1M	 112K   root        root       N-     -       1   S        1     0%   vmtoolsd
28605   59m08s    7h19m      1.1G   82280K     1.4G	 1.3G   omni        omni       N-     -       1   S        0     0%   php-fpm
28883   58m55s    7h19m      1.1G   84624K     1.4G	 1.1G   omni        omni       N-     -       1   S        1     0%   php-fpm
28720   59m07s    7h19m      1.1G   89484K     1.6G	 1.0G   omni        omni       N-     -       1   S        3     0%   php-fpm
28604   58m44s    7h19m      1.2G   110.0M     1.3G	 1.1G   omni        omni       N-     -       1   S        1     0%   php-fpm
28719   58m41s    7h19m      1.1G   83596K     1.3G	 1.1G   omni        omni       N-     -       1   S        2     0%   php-fpm
28759   58m42s    7h18m      1.1G   93196K     1.4G	 1.1G   omni        omni       N-     -       1   S        1     0%   php-fpm
28707   58m24s    7h16m      1.1G   88104K     1.4G	 1.1G   omni        omni       N-     -       1   S        1     0%   php-fpm
    9    5h32m    0.00s        0K	0K	 0K        0K   root        root       N-     -       1   S        3     0%   rcu_sched
10535   37m04s    4h33m      1.1G   64628K     1.1G    656.0M   omni        omni       N-     -       1   S        1     0%   php-fpm
  496    4h46m    0.00s        0K	0K    10.3G        0K   root        root       N-     -       1   S        0     0%   xfsaild/dm-0
    1    2h04m   92m53s    186.7M    2648K   126.9G    916.5G   root        root       N-     -       1   S        1     0%   systemd
  848   38m26s    2h11m    58656K    1368K   160.3M        0K   dbus        dbus       N-     -       1   S        0     0%   dbus-daemon
24452   47m51s   48m01s    292.4M   14628K   79272K     10.7G   redis       redis      N-     -       4   S        1     0%   redis-server
 1348   12m31s   78m27s    560.7M     608K   110.2M	  16K   root        root       N-     -       5   S        0     0%   tuned
  843   47m06s   35m49s    26616K    1092K   146.6M        0K   root        root       N-     -       1   S        3     0%   systemd-logind
26062   27m59s   45m31s    724.0M    4732K     1.2G	  36K   root        root       N-     -      15   S        0     0%   containerd
 1352   32m34s   32m29s    397.4M    9984K   176.7M	 9.3G   root        root       N-     -       3   S        0     0%   rsyslogd
  842   12m52s   37m29s    699.9M    3740K   258.7M        0K   polkitd     polkitd    N-     -       7   S        2     0%   polkitd
  579   30m24s   18m44s    47656K   12240K   164.1M        0K   root        root       N-     -       1   S        3     0%   systemd-journa
  987   18m04s   29m09s    465.3M    1376K   347.8M	  52K   root        root       N-     -       3   S        2     0%   NetworkManager
</pre>