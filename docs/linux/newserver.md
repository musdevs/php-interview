# Настройка нового сервера CentOS

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

dnf install nginx
df -h
firewall-cmd --permanent --add-port=80/tcp
firewall-cmd --permanent --add-port=443/tcp
firewall-cmd --reload
systemctl enable nginx
systemctl start nginx
