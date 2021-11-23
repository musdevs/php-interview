# Firewall

Открыть порт для HTTPS:

```shell
firewall-cmd --change-interface enp4s0 --zone=FedoraWorkstation --permanent
firewall-cmd --add-service https --permanent
firewall-cmd --reload
```

## Links

* [Control the firewall at the command line](https://fedoramagazine.org/control-the-firewall-at-the-command-line/)
