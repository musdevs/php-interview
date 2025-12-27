# Samba

1. Установка Samba

```shell
sudo apt update
sudo apt install samba
```

2. Создание общей папки

Создавать лучше в /var.
В /home проблема с доступом, нужно свой домашний каталог открывать для всех

```shell
mkdir /var/shared
sudo chown $USER:$USER /var/shared/
sudo chmod 777 /var/shared
```

3. Настройка Samba

```shell
sudo vi /etc/samba/smb.conf
```

```
[shared]
  comment = Shared folder for exchange
  path = /var/shared
  browseable = yes
  read only = no
  guest ok = yes
  create mask = 0777
  directory mask = 0777
```

4. Перезапуск Samba

```shell
sudo systemctl restart smbd
sudo systemctl enable smbd
```

5. Доступ с Windows
   В проводнике Windows введите:

```
\\ip-адрес-ubuntu\shared
```

6. Если нужно выдать права пользователям:

Добавить пользователя и пароль:

```shell
sudo smbpasswd -a ваш_пользователь
```

Если не помним пользователя, посмотрим существующих:
```shell
sudo pdbedit -L
```

Удалить:
```shell
sudo smbpasswd -x ваш_пользователь
```

```
[shared]
  comment = Shared folder for exchange
  path = /var/shared
  browseable = yes
  read only = no
  create mask = 0777
  directory mask = 0777
  guest ok = no
  valid users = ваш_пользователь
```
