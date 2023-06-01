# Elastic

NoSQL хранилище.

## Достоинства

Масштабируемость – кластер расширяется «на лету» добавлением новых серверов. Автораспределение нагрузки по узлам.
Отказоустойчивость — в случае сбоя данные не потеряются, а будут автоматически перераспределены. Логи ведутся сразу на нескольких узлах.
Гибкость поисковых фильтров. Нечеткий поиск, работы с восточными языками и мультиарендность (можно динамически организовать несколько различных поисковых систем). Автоматическая токенизацию, лемматизацию, стемминг.
Управляемость ES по HTTP с помощью JSON-запросов за счет REST API и визуального веб-интерфейса Kibana.
Универсальность – Logsatsh в потоковом режиме работает одновременно со множеством разных источников данных, фильтруя и преобразуя их для отправки в хранилище ES.

## Недостатки
- Высокое потребление ресурсов (CPU и RAM) из-за использования JVM.
- Сложность QueryDSL
- Проблемы с информационной безопасностью

## Примеры

### Список индексов

```
GET /_aliases
```

```
GET /_cat/indices?v=true
health status index                                     uuid                   pri rep docs.count docs.deleted store.size pri.store.size
yellow open   omni_actions                              di0DgWIES6u8L-FMzzUOig   3   3        280            9    746.6kb        746.6kb
green  open   .kibana_task_manager_7.13.1_001           E3zSZsriR1Wq7NivWQ-HJQ   1   0         11          659    600.2kb        600.2kb
green  open   .transform-internal-007                   YGklCx5cTRK4w88MOfYmzw   1   0          3            0     25.8kb         25.8kb
yellow open   .lists-default-000001                     _1qZAXJ1SfCXIMwR5zIthA   1   1          0            0       208b           208b
green  open   .apm-agent-configuration                  isk0ZsKRTkCT1ssfltjsCQ   1   0          0            0       208b           208b
green  open   .kibana-event-log-7.13.1-000001           eRXvPB0qR3GOgdah-F81fA   1   0          6            0     32.5kb         32.5kb
yellow open   filebeat-7.15.1-2021.10.15-000001         UfbT339bTZ2IOMie80EFFA   1   1         49            0    231.1kb        231.1kb
yellow open   omni_coupons                              mUr9zCTVTPiRiJVQe4QpUA   3   3          0            0     13.2kb         13.2kb
yellow open   omni_partners                             6JRSbL7YR5eRkDhPHmjlJg   3   3        644           40      1.2mb          1.2mb
yellow open   .items-default-000001                     jyTnjrc6STK_ANqILPRKLA   1   1          0            0       208b           208b
yellow open   omni_sberclub                             _1LcURC3S-aMF_8Do_RoAg   3   3         16            0    106.6kb        106.6kb
green  open   .tasks                                    kG75GPGSTwqHCkYQLfeuuQ   1   0         10            0     61.9kb         61.9kb
green  open   metrics-endpoint.metadata_current_default zowTA-_iTlezUxqGhfAzJQ   1   0          0            0       208b           208b
green  open   .security-7                               qCIyvNwtSvS8YjKtQ9Ruvg   1   0         48            0    185.3kb        185.3kb
green  open   .apm-custom-link                          Jqc4YqK5T1-FQ60Knpblcw   1   0          0            0       208b           208b
yellow open   omni_events                               sZo1JBwgTIamFZ2gevhZgQ   3   3      20805         6753       60mb           60mb
green  open   .kibana_7.13.1_001                        JAWatELaQQyOpNdz3uZWeA   1   0        192            4      2.3mb          2.3mb
green  open   .async-search                             xtpvlIytQlqaYmZiAw18WQ   1   0          0            0       231b           231b
```

### Изменить маппинг поля

```shell
PUT /books/_mapping
{
    "properties": {
        "category": {
            "type": "text",
            "fields": {
                "ru": {
                    "type": "text",
                    "analyzer": "russian"
                }
            }
        }
    }
}
```

* [Response body](https://www.elastic.co/guide/en/elasticsearch/reference/current/search-search.html#search-api-response-body)

* [Глоссарий ElasticSearch](https://habr.com/ru/sandbox/115014/)
