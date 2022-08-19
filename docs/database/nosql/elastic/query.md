## Типы запросов

### Полнотекстовые запросы

#### Prefix query

```
GET omni_partners/_search
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
GET omni_partners/_search
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
GET omni_partners/_search
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
GET omni_partners/_search
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
GET omni_partners/_search
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
