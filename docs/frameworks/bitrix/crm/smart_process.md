# Смарт-процессы CRM

## Где увидеть список всех цифровых рабочих мест

### В интерфейсе

1. В левом главном меню найдите и нажмите раздел «Автоматизация»
2. В верхнем меню выбрать пункт «Цифровые рабочие места»

### REST API

[Цифровые рабочие места](https://apidocs.bitrix24.ru/api-reference/crm/automated-solution/index.html)

```
GET crm.automatedsolution.list

{
	"result": {
		"automatedSolutions": [
			{
				"id": 1,
				"title": "Закупки",
				"typeIds": [
					17
				]
			}
		]
	},
	"total": 1,
	"time": {...}
}
```
