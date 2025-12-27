# Диски

## Восстановление файловой системы

### NTFS

```shell
sudo ntfsfix /dev/sdb5
```

## Информация о дисках

### hwinfo

```
hwinfo --disk
35: PCI 00.0: 10600 Disk
  [Created at block.245]
  Unique ID: wLCS.rgUczaerBoD
  Parent ID: B35A.nIUKU6+pYDD
  SysFS ID: /class/block/nvme0n1
  SysFS BusID: nvme0
  SysFS Device Link: /devices/pci0000:00/0000:00:01.2/0000:02:00.0/nvme/nvme0
  Hardware Class: disk
  Model: "SK hynix Disk"
  Vendor: pci 0x1c5c "SK hynix"
  Device: pci 0x174a
  SubVendor: pci 0x1c5c "SK hynix"
  SubDevice: pci 0x174a
  Driver: "nvme"
  Driver Modules: "nvme"
  Device File: /dev/nvme0n1
  Device Files: /dev/nvme0n1, /dev/disk/by-id/nvme-SKHynix_HFS001TDE9X084N_ANABN85931160C254, /dev/disk/by-id/nvme-nvme.1c5c-414e41424e383539333131363043323534-534b48796e69785f48465330303154444539583038344e-00000001, /dev/disk/by-path/pci-0000:02:00.0-nvme-1, /dev/disk/by-id/nvme-SKHynix_HFS001TDE9X084N_ANABN85931160C254_1
  Device Number: block 259:0
  Drive status: no medium
  Config Status: cfg=new, avail=yes, need=no, active=unknown
  Attached to: #8 (Non-Volatile memory controller)
```

### smartmontools

```shell
sudo apt install smartmontools
sudo smartctl -i /dev/nvme0n1я о диске -
smartctl 7.2 2020-12-30 r5155 [x86_64-linux-6.8.0-40-generic] (local build)
Copyright (C) 2002-20, Bruce Allen, Christian Franke, www.smartmontools.org

=== START OF INFORMATION SECTION ===
Model Number:                       SKHynix_HFS001TDE9X084N
Serial Number:                      ANABN85931160C254
Firmware Version:                   41010C22
PCI Vendor/Subsystem ID:            0x1c5c
IEEE OUI Identifier:                0xace42e
Controller ID:                      1
NVMe Version:                       1.3
Number of Namespaces:               1
Namespace 1 Size/Capacity:          1 024 209 543 168 [1,02 TB]
Namespace 1 Formatted LBA Size:     512
Namespace 1 IEEE EUI-64:            ace42e 001681a049
Local Time is:                      Thu Sep 26 09:58:02 2024 MSK

```



https://www.8host.com/blog/razdelenie-i-formatirovanie-diskov-v-linux/

https://losst.ru/rsync-primery-sinhronizatsii

## Список подключенных дисков

```
ls -l /dev/
brw-rw----  1 root   disk    253,   0 Mar 15 03:17 vda
brw-rw----  1 root   disk    253,   1 Mar 15 03:17 vda1
brw-rw----  1 root   disk    253,  16 Feb 25 17:56 vdb
brw-rw----  1 root   disk    253,  17 Apr  3  2020 vdb1
brw-rw----  1 root   disk    253,  32 Apr  3  2020 vdc
brw-rw----  1 root   disk    253,  33 Apr  3  2020 vdc1
brw-rw----  1 root   disk    253,  48 Mar 12 17:37 vdd
```




```
lsblk
NAME   MAJ:MIN RM  SIZE RO TYPE MOUNTPOINT
sr0     11:0    1 1024M  0 rom
vda    253:0    0  100G  0 disk
└─vda1 253:1    0  100G  0 part /
vdb    253:16   0    2T  0 disk
└─vdb1 253:17   0  1.5T  0 part /home
vdc    253:32   0  500G  0 disk
└─vdc1 253:33   0  500G  0 part /home/bitrix/www/bitrix/backup
vdd    253:48   0    2T  0 disk
```



```
lsblk --fs
NAME   FSTYPE LABEL UUID                                 MOUNTPOINT
sr0
vda
└─vda1 ext4         ecab951b-56f3-4b3d-8245-bc9c4f4123fd /
vdb
└─vdb1 ext4         af6a9faa-c274-434f-91d8-1406fd57b634 /home
vdc
└─vdc1 ext4         e1d1bbcd-9867-4ac5-9864-e6eb87da3448 /home/bitrix/www/bitrix/backup
vdd
```

```
# lsblk -o name,fstype,size,uuid,type,label,mountpoint
NAME   FSTYPE   SIZE UUID                                 TYPE LABEL   MOUNTPOINT
fd0               4K                                      disk
sda             270G                                      disk
├─sda1 ext4     200M 41db4f2a-a8f1-4b3a-a3ca-3658b870f035 part bxBoot  /boot
├─sda2 swap     512M 9e2b3316-e5bb-4c8f-898c-536c7ced9623 part bxSwap  [SWAP]
└─sda3 ext4   269,3G 4aacb6c2-b435-4e63-b652-ad403eac9c6c part bxRoot  /
sdb             853G                                      disk
└─sdb1 ext4     853G 067e0ce2-fbcc-4992-adaa-e75e7083a395 part b24disk /home/bitrix/www/upload/disk
sdc             2,5T                                      disk
└─sdc1 ext4       2T 58dac841-2a03-414c-bd47-c1db5d33262d part         /mnt/bitrix_upload
sr0            1024M                                      rom
```


```
fdisk -l

Disk /dev/vda: 107.4 GB, 107374182400 bytes, 209715200 sectors
Units = sectors of 1 * 512 = 512 bytes
Sector size (logical/physical): 512 bytes / 512 bytes
I/O size (minimum/optimal): 512 bytes / 512 bytes
Disk label type: dos
Disk identifier: 0x0005d66c

   Device Boot      Start         End      Blocks   Id  System
/dev/vda1   *        2048   209715199   104856576   83  Linux

Disk /dev/vdb: 2147.5 GB, 2147483648000 bytes, 4194304000 sectors
Units = sectors of 1 * 512 = 512 bytes
Sector size (logical/physical): 512 bytes / 512 bytes
I/O size (minimum/optimal): 512 bytes / 512 bytes
Disk label type: dos
Disk identifier: 0x000de3ac

   Device Boot      Start         End      Blocks   Id  System
/dev/vdb1            2048  3145727999  1572862976   83  Linux

Disk /dev/vdc: 536.9 GB, 536870912000 bytes, 1048576000 sectors
Units = sectors of 1 * 512 = 512 bytes
Sector size (logical/physical): 512 bytes / 512 bytes
I/O size (minimum/optimal): 512 bytes / 512 bytes
Disk label type: dos
Disk identifier: 0x2273573b

   Device Boot      Start         End      Blocks   Id  System
/dev/vdc1            2048  1048575999   524286976   83  Linux

Disk /dev/vdd: 2147.5 GB, 2147483648000 bytes, 4194304000 sectors
Units = sectors of 1 * 512 = 512 bytes
Sector size (logical/physical): 512 bytes / 512 bytes
I/O size (minimum/optimal): 512 bytes / 512 bytes
```






```
parted -l
Model: Virtio Block Device (virtblk)
Disk /dev/vda: 107GB
Sector size (logical/physical): 512B/512B
Partition Table: msdos
Disk Flags:

Number  Start   End    Size   Type     File system  Flags
 1      1049kB  107GB  107GB  primary  ext4         boot


Model: Virtio Block Device (virtblk)
Disk /dev/vdb: 2147GB
Sector size (logical/physical): 512B/512B
Partition Table: msdos
Disk Flags:

Number  Start   End     Size    Type     File system  Flags
 1      1049kB  1611GB  1611GB  primary  ext4


Model: Virtio Block Device (virtblk)
Disk /dev/vdc: 537GB
Sector size (logical/physical): 512B/512B
Partition Table: msdos
Disk Flags:

Number  Start   End    Size   Type     File system  Flags
 1      1049kB  537GB  537GB  primary  ext4


Error: /dev/vdd: unrecognised disk label
Model: Virtio Block Device (virtblk)
Disk /dev/vdd: 2147GB
Sector size (logical/physical): 512B/512B
Partition Table: unknown
Disk Flags:
```








```
parted -l | grep Error
Error: /dev/vdd: unrecognised disk label
```



```
sudo parted /dev/vdd mklabel msdos
Information: You may need to update /etc/fstab.
```




```
lsblk
NAME   MAJ:MIN RM  SIZE RO TYPE MOUNTPOINT
sr0     11:0    1 1024M  0 rom
vda    253:0    0  100G  0 disk
└─vda1 253:1    0  100G  0 part /
vdb    253:16   0    2T  0 disk
└─vdb1 253:17   0  1,5T  0 part /home
vdc    253:32   0  500G  0 disk
└─vdc1 253:33   0  500G  0 part /home/bitrix/www/bitrix/backup
vdd    253:48   0    2T  0 disk
└─vdd1 253:49   0    2T  0 part
```


```
sudo mkfs.ext4 -L b24disk /dev/vdd1
mke2fs 1.42.9 (28-Dec-2013)
Filesystem label=b24disk
OS type: Linux
Block size=4096 (log=2)
Fragment size=4096 (log=2)
Stride=0 blocks, Stripe width=0 blocks
131072000 inodes, 524287744 blocks
26214387 blocks (5.00%) reserved for the super user
First data block=0
Maximum filesystem blocks=2671771648
16000 block groups
32768 blocks per group, 32768 fragments per group
8192 inodes per group
Superblock backups stored on blocks:
	32768, 98304, 163840, 229376, 294912, 819200, 884736, 1605632, 2654208,
	4096000, 7962624, 11239424, 20480000, 23887872, 71663616, 78675968,
	102400000, 214990848, 512000000

Allocating group tables: done
Writing inode tables: done
Creating journal (32768 blocks): done
Writing superblocks and filesystem accounting information: done
```

```
sudo lsblk --fs
NAME   FSTYPE LABEL   UUID                                 MOUNTPOINT
sr0
vda
└─vda1 ext4           ecab951b-56f3-4b3d-8245-bc9c4f4123fd /
vdb
└─vdb1 ext4           af6a9faa-c274-434f-91d8-1406fd57b634 /home
vdc
└─vdc1 ext4           e1d1bbcd-9867-4ac5-9864-e6eb87da3448 /home/bitrix/www/bitrix/backup
vdd
└─vdd1 ext4   b24disk 03a3e7c9-e375-441b-b722-a400f990b9e7
```



```
sudo mount -t ext4 /dev/vdd1 /mnt/b24disk
```




```
sudo fsck.ext4 -f /dev/vdd1
e2fsck 1.42.9 (28-Dec-2013)
Pass 1: Checking inodes, blocks, and sizes
Pass 2: Checking directory structure
Pass 3: Checking directory connectivity
Pass 4: Checking reference counts
Pass 5: Checking group summary information
b24disk: 11/131072000 files (0.0% non-contiguous), 8282274/524287744 blocks
```

<pre><code>lshw -short -C disk</code></pre>
<pre><code>fdisk -l</code></pre>
<a href="http://blog.korphome.ru/2012/09/10/%D1%83%D1%87%D0%B8%D0%BC%D1%81%D1%8F-%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D0%B0%D1%82%D1%8C-%D1%81%D0%BE-smart-%D0%B8%D0%BB%D0%B8-%D0%B3%D0%B0%D0%B4%D0%B0%D0%BD%D0%B8%D0%B5-%D0%BD%D0%B0-%D0%B1%D0%BB%D0%B8/">Ошибки</a> диска:
<pre><code>smartctl -l error /dev/sda</code></pre>
Когда нужно узнать на каком физическом диске находится каталог
<pre><code>[root@server ~]# df /home
Filesystem                1K-blocks      Used Available Use% Mounted on
/dev/mapper/fedora00-home 179851664 151229640  19462960  89% /home
</code></pre>
Но если это логический раздел LVM, как показано выше /dev/mapper/fedora00-home, то pvscan покажет расположение группы томов на физических разделах. Группа fedora00 расположена на разделе /dev/sda3:
<pre><code>[root@server ~]# pvscan
  PV /dev/sdc3   VG fedora          lvm2 [232.20 GiB / 64.00 MiB free]
  PV /dev/sda3   VG fedora00        lvm2 [232.20 GiB / 4.00 MiB free]
  Total: 2 [464.40 GiB] / in use: 2 [464.40 GiB] / in no VG: 0 [0   ]
</code></pre>
Все сразу:
<pre><code>lshw -short -C processor -C memory -C disk</code></pre>

## Производительность дисков

### fio

fio создаёт четыре параллельных задачи, которые читают случайные блоки
по 4 KB из 1 GB файла в течение 30 секунд, используя движок io_uring.
Результат: сколько твой диск может обработать случайных операций за секунду

```shell

fio --name=test \
    --ioengine=io_uring \
    --rw=randread \
    --bs=4k \
    --size=1G \
    --numjobs=4 \
    --runtime=30s \
    --group_reporting
```

```shell
test: (g=0): rw=randread, bs=(R) 4096B-4096B, (W) 4096B-4096B, (T) 4096B-4096B, ioengine=io_uring, iodepth=1
...
fio-3.36
Starting 4 processes
test: Laying out IO file (1 file / 1024MiB)
test: Laying out IO file (1 file / 1024MiB)
test: Laying out IO file (1 file / 1024MiB)
test: Laying out IO file (1 file / 1024MiB)
Jobs: 4 (f=4): [r(4)][100.0%][r=230MiB/s][r=58.9k IOPS][eta 00m:00s]
test: (groupid=0, jobs=4): err= 0: pid=416477: Thu Nov  6 14:03:22 2025
  read: IOPS=61.5k, BW=240MiB/s (252MB/s)(4096MiB/17046msec)
    slat (usec): min=6, max=178, avg= 9.71, stdev= 2.15
    clat (nsec): min=977, max=6345.5k, avg=52292.62, stdev=24687.86
     lat (usec): min=21, max=6359, avg=62.00, stdev=24.80
    clat percentiles (usec):
     |  1.00th=[   48],  5.00th=[   49], 10.00th=[   49], 20.00th=[   50],
     | 30.00th=[   50], 40.00th=[   50], 50.00th=[   51], 60.00th=[   51],
     | 70.00th=[   52], 80.00th=[   53], 90.00th=[   57], 95.00th=[   60],
     | 99.00th=[   79], 99.50th=[   85], 99.90th=[  167], 99.95th=[  227],
     | 99.99th=[  783]
   bw (  KiB/s): min=234128, max=249680, per=100.00%, avg=246347.76, stdev=890.30, samples=136
   iops        : min=58532, max=62420, avg=61586.94, stdev=222.57, samples=136
  lat (nsec)   : 1000=0.01%
  lat (usec)   : 2=0.01%, 4=0.01%, 10=0.01%, 20=0.01%, 50=40.20%
  lat (usec)   : 100=59.52%, 250=0.22%, 500=0.02%, 750=0.01%, 1000=0.01%
  lat (msec)   : 2=0.01%, 4=0.01%, 10=0.01%
  cpu          : usr=2.49%, sys=27.16%, ctx=1051673, majf=0, minf=52
  IO depths    : 1=100.0%, 2=0.0%, 4=0.0%, 8=0.0%, 16=0.0%, 32=0.0%, >=64=0.0%
     submit    : 0=0.0%, 4=100.0%, 8=0.0%, 16=0.0%, 32=0.0%, 64=0.0%, >=64=0.0%
     complete  : 0=0.0%, 4=100.0%, 8=0.0%, 16=0.0%, 32=0.0%, 64=0.0%, >=64=0.0%
     issued rwts: total=1048576,0,0,0 short=0,0,0,0 dropped=0,0,0,0
     latency   : target=0, window=0, percentile=100.00%, depth=1

Run status group 0 (all jobs):
   READ: bw=240MiB/s (252MB/s), 240MiB/s-240MiB/s (252MB/s-252MB/s), io=4096MiB (4295MB), run=17046-17046msec

Disk stats (read/write):
  nvme0n1: ios=1038962/1302, sectors=8311752/154408, merge=0/561, ticks=51661/353, in_queue=52057, util=52.27%
```
