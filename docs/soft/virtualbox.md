# VirtualBox

## Создание машины с Windows 11

Требования:

Base Memory: 4096 MB
Chipset: PIIX3
Enable I/O AIPC: true
Enable Hardwarte Clock in UTC Time: false
Enable EFI: false
Enable Secure Boot: false

Processor: 2

Display
Video Memory: 128 MB
Graphics Controller: VBoxSVGA

## Зависание Windows 11 с запущенным Chrome

Проверить режим kvm
$ lsmod | grep kvm
kvm_amd               208896  0
kvm                  1404928  1 kvm_amd
irqbypass              12288  1 kvm
ccp                   143360  1 kvm_amd

Отключить KVM
$ sudo modprobe -r kvm_amd
$ sudo modprobe -r kvm


Проверить еще раз kvm
$ lsmod | grep kvm


Отключить аппаратное ускорение Chrome
В адресной строке введите: chrome://settings/system
Отключите переключатель "Использовать аппаратное ускорение (если доступно)"

## Установка/обновление

Скачать для своей платформы https://www.virtualbox.org/wiki/Linux_Downloads и установить:

```shell
sudo apt install virtualbox-7.2_7.2.8-173730~Ubuntu~noble_amd64.deb
```

После установки запустить виртуалку и в нижней панели на значке CD-ROM
подключить образ Guest Additions /usr/share/virtualbox/VBoxGuestAdditions.iso
А затем внутри виртуалки в подключенном диске запустить VBoxLinuxAdditions.exe
