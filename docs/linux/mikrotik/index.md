# Mikrotik

## Работа в SSH

### Подключение

```shell
ssh -oHostKeyAlgorithms=+ssh-rsa admin@192.168.88.1
```

### Список команд

```shell
?
beep --
blink --
caps-man --
certificate -- Certificate management
console --
delay -- does nothing for a while
disk --
do -- executes command
driver -- Driver management
environment -- list of all variables
error -- make error value
execute -- run script as separate console job
file -- Local router file storage.
find -- Find items by value
for -- executes command for a range of integer values
foreach -- executes command for every element in a list
global -- set value global variable
if -- executes command if condition is true
import --
interface --
ip -- IP options
ipv6 --
len -- return number of elements in value
local -- set value of local variable
log -- System logs
mpls --
nothing -- do nothing and return nothing
parse -- build command from text
partitions --
password -- Change password
pick -- return range of string characters or array values
ping -- Send ICMP Echo packets
port -- Serial ports
ppp -- Point to Point Protocol
put -- prints argument on the screen
queue -- Bandwidth management
quit -- Quit console
radius -- Radius client settings
redo -- Redo previously undone action
resolve -- perform a dns lookup of domain name
return -- return value from function
routing --
set -- Change item properties
snmp -- SNMP settings
special-login -- Special login users
system --
terminal -- commands related to terminal handling
time -- returns time taken by command to execute
toarray -- convert argument to array value
tobool -- convert argument to truth value
toid -- convert argument to internal number value
toip -- convert argument to IP address value
toip6 -- convert argument to IPv6 address value
tonum -- convert argument to integer number value
tool -- Diagnostics tools
tostr -- convert argument to string value
totime -- convert argument to time interval value
typeof -- return type of value
undo -- Undo previous action
user -- User management
while -- executes command while condition is true
export -- Print or save an export script that can be used to restore configuration

```

### Переход в раздел system

```shell
[admin@MikroTik] > system
```

### Telnet

Помощь
```
[admin@MikroTik] /system> telnet ?
Run telnet session to remote host.

<address> -- IP address of host
<port> -- Port number
routing-table --
```

```
[admin@MikroTik] /system> telnet 192.168.88.66 443
Trying 192.168.88.66...
Connected to 192.168.88.66.
Escape character is '^]'.
```

### Telnet

```shell
[admin@MikroTik] /system> telnet 192.168.88.66 443
Trying 192.168.88.66...
Connected to 192.168.88.66.
Escape character is '^]'.
```
