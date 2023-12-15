# Информация о hardware

Разрешение монитора
```
xrandr --query
```

Разрешение экрана:

```
xrandr -q | grep '\*'
```

## Память

[В поисках памяти](http://www.binarytides.com/linux-command-check-memory-usage/)

```
$ free -m
$ cat /proc/meminfo
$ vmstat -s
$ dmidecode -t 17
```

Модули памяти:
<pre><code>dmidecode -t memory</code></pre>
<pre><code>dmidecode -t memory | grep Size</code></pre>

## Процессор

<pre><code>lscpu</code></pre>
<pre><code>cat /proc/cpuinfo</code></pre>
Количество ядер у процессора:
<pre><code>nproc</code></pre>


## Температура

Датчики температуры:

```
sensors
```

Датчики температуры HDD:

```
hddtemp
```

<a href="http://mydebianblog.blogspot.ru/2008/01/blog-post.html">Железо в Linux: Как узнать подробности оборудования в Linux?</a>
