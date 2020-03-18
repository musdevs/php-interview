# Маршрутизация

#!/usr/bin/bash

MYGATEWAY=192.168.100.1

ip route add default dev wlp0s26u1u6 metric 50
route add -net 10.10.0.0 netmask 255.255.0.0 gw $MYGATEWAY dev eno1
route add -net 192.168.0.0 netmask 255.255.0.0 gw $MYGATEWAY dev eno1
