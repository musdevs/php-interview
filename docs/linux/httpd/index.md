# Apache HTTPD

## Debug info

### Show loaded modules
```
apachectl -M
```

### Show loaded modules
```
apachectl -M
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