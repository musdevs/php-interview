# Apache HTTPD

## Debug info

### Help

```
# apachectl -h
Usage: /usr/sbin/apache2 [-D name] [-d directory] [-f file]
                         [-C "directive"] [-c "directive"]
                         [-k start|restart|graceful|graceful-stop|stop]
                         [-v] [-V] [-h] [-l] [-L] [-t] [-T] [-S] [-X]
Options:
  -D name            : define a name for use in <IfDefine name> directives
  -d directory       : specify an alternate initial ServerRoot
  -f file            : specify an alternate ServerConfigFile
  -C "directive"     : process directive before reading config files
  -c "directive"     : process directive after reading config files
  -e level           : show startup errors of level (see LogLevel)
  -E file            : log startup errors to file
  -v                 : show version number
  -V                 : show compile settings
  -h                 : list available command line options (this page)
  -l                 : list compiled in modules
  -L                 : list available configuration directives
  -t -D DUMP_VHOSTS  : show parsed vhost settings
  -t -D DUMP_RUN_CFG : show parsed run settings
  -S                 : a synonym for -t -D DUMP_VHOSTS -D DUMP_RUN_CFG
  -t -D DUMP_MODULES : show all loaded modules 
  -M                 : a synonym for -t -D DUMP_MODULES
  -t -D DUMP_INCLUDES: show all included configuration files
  -t                 : run syntax check for config files
  -T                 : start without DocumentRoot(s) check
  -X                 : debug mode (only one worker, do not detach)
```

### Show loaded modules
```
apachectl -M
```

### List all virtual hosts
```
# Red Hat-based (Fedora, CentOS)
httpd -S

# Debian-based (Ubuntu)
apache2ctl -S

# apachectl -S
ServerRoot: "/etc/apache2"
Main DocumentRoot: "/var/www/html"
Main ErrorLog: "/var/log/apache2/error.log"
Mutex rewrite-map: using_defaults
Mutex default: dir="/var/run/apache2/" mechanism=default 
Mutex mpm-accept: using_defaults
Mutex watchdog-callback: using_defaults
PidFile: "/var/run/apache2/apache2.pid"
Define: DUMP_VHOSTS
Define: DUMP_RUN_CFG
User: name="www-data" id=33
Group: name="www-data" id=33
```


### Show included config files

```
# apachectl -t -D DUMP_INCLUDES
Included configuration files:
  (*) /etc/apache2/apache2.conf
    (146) /etc/apache2/mods-enabled/access_compat.load
    (146) /etc/apache2/mods-enabled/alias.load
    ...
    (225) /etc/apache2/sites-enabled/000-default.conf
```

### Reread config
```
apachectl -k graceful
```

### Set max log level in the container
```
apt-get install vim
vi /etc/apache2/apache2.conf
LogLevel trace8
apachectl -k graceful
```

### envvars

Default environment variables for apache2ctl

```shell
cat /etc/apache2/envvars
```