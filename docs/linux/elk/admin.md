# Администрирование Elastik Stack

## Заметки
Контекст статьи [Elastic для маленьких. Оптимизируем для небольшой компании](https://esguardian.ru/2016/12/25/elastic-for-little-ones-optimize-for-a-small-company/)

Ежедневный индекс — это самое разумное решение для технических журналов.

Шаблон для создания индексов указывается так:
```
output {
if "winlogbeat" in [tags] {
elasticsearch {
hosts => ["127.0.0.1:9200"]
index => "winlogbeat-%{+YYYY.MM.dd}"
document_type => "winlogbeat"
template => "/etc/logstash/winlogbeat.template-es2x.json"
template_name => "winlogbeat"
template_overwrite => true
}

    }
}
```

Elastic не занимается разбиением индексов по датам, об этом должно заботиться приложение, которое отправляет ему данные.

в документе должно быть поле @timestamp

Слишком большие индексы — плохо, поскольку внутри них трудно будет искать. Слишком маленькие — тоже плохо, поскольку нужно будет тратить время на склеивание.

Хорошо, когда индекс таков, что большинство нужных поисковых запросов делается в пределах одного индекса, и он целиком помещается в оперативную память. Точнее говоря, в память должен помещаться шард. На практике, 2GB — вполне хороший размер даже без разбивки на шарды.

Elastic, кстати не станет хранить две копии шарда на одном узле, поэтому требовать создания реплики в случае единственного узла бессмысленно.

Состояние кластера:
```
GET _cluster/stats?human
```

Информация по шардам:
```
GET _cat/shards?v
index                               shard prirep state      docs   store ip        node
.kibana_task_manager_7.13.1_001     0     p      STARTED      11 898.5kb 127.0.0.1 elk
.apm-custom-link                    0     p      STARTED       0    208b 127.0.0.1 elk
.ds-ilm-history-5-2021.10.18-000001 0     p      STARTED                 127.0.0.1 elk
nginx-index                         0     p      STARTED       4  53.8kb 127.0.0.1 elk
nginx-index                         0     r      UNASSIGNED
.kibana_security_session_1          0     p      STARTED                 127.0.0.1 elk
.apm-agent-configuration            0     p      STARTED       0    208b 127.0.0.1 elk
.kibana-event-log-7.13.1-000001     0     p      STARTED       4  21.8kb 127.0.0.1 elk
.kibana_7.13.1_001                  0     p      STARTED     121   4.3mb 127.0.0.1 elk
.security-7                         0     p      STARTED      48 185.3kb 127.0.0.1 elk
.async-search                       0     p      STARTED       0  21.9kb 127.0.0.1 elk
.tasks                              0     p      STARTED       6  34.8kb 127.0.0.1 elk
```
