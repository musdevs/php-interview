# SSH

## Ручное добавление SSH-ключа на удаленном хосте

Если файла ~/.ssh/authorized_keys на удаленном хосте не существует, то создать его

```shell
mkdir --mode=700 ~/.ssh
touch ~/.ssh/authorized_keys
chmod 600 ~/.ssh/authorized_keys
```

Вывести содержимое локального ключа
```shell
cat ~/.ssh/id_rsa.pub
```

И сохранить в удаленном файле
```shell
vi ~/.ssh/authorized_keys
```

## Монтирование удаленного каталога

```shell
sshfs user1@192.168.1.1:/home/user1 /mnt/user1 -o uid=500,gid=500 -o allow_other -o kernel_cache -o auto_cache -o reconnect -o compression=no -o cache_timeout=600 -o IdentityFile=/home/user/.ssh/id_rsa
```

## Настройка SSH-сервера

```
sudo apt install openssh-server
sudo systemctl enable ssh

```
