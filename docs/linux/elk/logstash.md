# Logstash

ETL - Extract, Transform and Load - извлечение, трансформация и загрузка

ETL-движок сбора данных 

## Настройка

### Пароль для ES

/usr/share/logstash/config/logstash.yml

```yaml
http.host: "0.0.0.0"
xpack.monitoring.elasticsearch.hosts: [ "http://localhost:9200" ]
xpack.monitoring.elasticsearch.username: "elastic"
xpack.monitoring.elasticsearch.password: "secret"
```

## Links

* [Transforming and sending Nginx log data to Elasticsearch using Filebeat and Logstash — Part 1](https://medium.com/krakensystems-blog/transforming-and-sending-nginx-log-data-to-elasticsearch-using-filebeat-and-logstash-part-1-61e4e19f5e54)
* [Transforming and sending Nginx log data to Elasticsearch using Filebeat and Logstash — Part 2](https://medium.com/krakensystems-blog/transforming-and-sending-nginx-log-data-to-elasticsearch-using-filebeat-and-logstash-part-2-754c1d7f1a00)
