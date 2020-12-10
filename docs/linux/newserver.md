# Настройка нового сервера

Обновить пакеты
```
dnf update
```

useradd vvs -G wheel

Изменить SSH-порт
```
sudo cp /etc/ssh/sshd_config /etc/ssh/sshd_config.bak
vi /etc/ssh/sshd_config
sudo visudo
sudo vi /etc/ssh/sshd_config
sudo semanage port -a -t ssh_port_t -p tcp 21589
sudo firewall-cmd --permanent --zone=public --add-port=21589/tcp
sudo firewall-cmd --reload
sudo systemctl restrt sshd.service
ss -tlnp | grep 21589
```

11  dnf install nginx
12  df -h
13  firewall-cmd --permanent --add-port=80/tcp
14  firewall-cmd --permanent --add-port=443/tcp
15  firewall-cmd --reload
16  sytemctl enable nginx
17  systemctl enable nginx
18  systemctl start nginx
