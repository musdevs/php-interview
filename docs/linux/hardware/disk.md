https://www.8host.com/blog/razdelenie-i-formatirovanie-diskov-v-linux/

https://losst.ru/rsync-primery-sinhronizatsii

Список подключенных дисков

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

