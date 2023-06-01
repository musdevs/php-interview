## Типы запросов

### Полнотекстовые запросы

#### По всем полям

```
GET partners/_search
{
  "query": {
      "query_string": {
        "query": "*гк*"
      }
  }
}
```

#### Prefix query

```
GET partners/_search
{
"query": {
  "prefix": {
    "name": "док"
  }
},
"_source": ["name"]
}

"Клиника Доктора Шаталова"
"Доктор Столетов"
```

### Term-запросы

```
GET /amazon_products/products/_search
{
  "query": {
    "term": {
      "manufacturer.raw": "victory multimedia"
    }
  }
}
```

### запрос существования
### запрос диапазона

## Примеры

### Искать в поле хотя бы одно слово ("operator": "or")

```
GET partners/_search
{
  "query": {
    "match": {
      "stock_up": {
        "query": "покупки Пермфармация",
        "operator": "or"
      }
    }
 }
}
```

### Искать в поле все слова ("operator": "and")

```
GET partners/_search
{
  "query": {
    "match": {
      "stock_up": {
        "query": "покупки Пермфармация",
        "operator": "and"
      }
    }
 }
}
```

### Задать минимальное кол-во совпадающих термов (2 из 3)

```
GET partners/_search
{
  "query": {
    "match": {
      "stock_up": {
        "query": "покупки «Пермфармация» аптеках",
        "minimum_should_match": 2
      }
    }
 }
}
```

### Нечеткость

```
GET partners/_search
{
  "query": {
    "match": {
      "stock_up": {
        "query": "покупки Пермфармация аптеках",
        "minimum_should_match": 2,
        "fuzziness": 2
      }
    }
 }
}
```

Добавит документы с неполным совпадением слов. Например, "аптека", "аптеки" и т.д.

fuzziness: 0, 1, 2, "AUTO" - чем больше значение, тем больше выборка

### Сложные запросы ИЛИ

```
GET partners/_search
{
  "query": {
     "_source": [ "id", "name" ],
    "bool": {
      "should": [
        {
          "query_string": {
            "query": "*гк*"
          }
        },
        {
          "query_string": {
            "default_field": "name",
            "query": "*гк*",
            "boost": 2
          }
        },
        {
          "term": {
            "name": "гк"
          }
        }
      ]
    }
  }
}
```

"boost": 2 - увеличение веса условия

term-запросы выдают более высокий SCORE, чем query_string

### Фильтры в запросах

И поисковый запрос (query), и фильтр (filter) принимают на вход запросы в одном формате, но с той лишь разницей, что запросы, написанные внутри filter, не влияют на итоговое значение _score. Подробнее см. в [Строим продвинутый поиск с ElasticSearch](https://dou.ua/lenta/columns/building-advanced-search-with-elasticsearch/):

```
GET partners/_search
{
    "size": 100,
    "query": {
        "bool": {
            "filter": {
                "term": {
                    "isOnlyAdults": true
                }
            }
        }
    }
}
```
