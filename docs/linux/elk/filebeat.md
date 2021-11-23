# Filebeat

Проверка конфигурации

```shell
sudo filebeat test config
Config OK
```

Список модулей:
```shell
sudo filebeat modules list
```

Подключение модулей:
```shell
filebeat modules enable system nginx mysql
```

* [Подключение модулей](https://www.elastic.co/guide/en/beats/filebeat/7.13/filebeat-installation-configuration.html#collect-log-data)
