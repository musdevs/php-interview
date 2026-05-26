# Вызов REST-методов в коробке

## Вызов REST-методов из PHP

### С помощью класса CRestServer

```php
function call_rest_method(string $method, array $data = []): array {
	$server = new CRestServer([
		'CLASS' => null,
		'METHOD' => $method,
		'TRANSPORT' => 'json',
		'QUERY' => array_merge($data, ['sessid' => bitrix_sessid(),])
	], false);

	return $server->process();
}

$result = call_rest_method('crm.type.list', [
	'id' => 'RUB',
]);
```

### Если знать контроллер

```php
\Bitrix\Main\Loader::requireModule('crm');
$controller = new \Bitrix\Crm\Controller\Category();
$result = $controller->listAction(1074);
$result = new Bitrix\Main\Engine\Response\AjaxJson($result);
$result = $result->getContent();
$result = json_decode($result, true);
```

## Вызов REST-методов из JavaScript

### В PHP-скрипте

```php
\Bitrix\Main\UI\Extension::load("rest.client");
?>
<script>
	BX.ready(async function () {
		const result = await BX.rest.callMethod('crm.currency.get', {id: 'RUB'});
		console.log(result);
	})
</script>
```

### В JS-скрипте

```javascript
	BX.ready(async function () {
    await BX.Runtime.loadExtension("rest.client");
		const result = await BX.rest.callMethod('crm.currency.get', {id: 'RUB'});
		console.log(result);
	})
</script>
```


```json
{
    "answer": {
        "result": {
            "CURRENCY": "RUB",
            "AMOUNT_CNT": "1",
            "AMOUNT": "1.0000",
            "SORT": "100",
            "BASE": "Y",
            "FULL_NAME": "Российский рубль",
            "LID": "ru",
            "FORMAT_STRING": "# &#8381;",
            "DEC_POINT": ".",
            "THOUSANDS_SEP": null,
            "DECIMALS": "2",
            "DATE_UPDATE": "2026-02-27T18:13:10+03:00",
            "LANG": {
                "en": {
                    "FORMAT_STRING": "&#8381;#",
                    "FULL_NAME": "Russian Ruble",
                    "DEC_POINT": ".",
                    "THOUSANDS_SEP": null,
                    "DECIMALS": "2",
                    "THOUSANDS_VARIANT": "C",
                    "HIDE_ZERO": "Y"
                },
                "ru": {
                    "FORMAT_STRING": "# &#8381;",
                    "FULL_NAME": "Российский рубль",
                    "DEC_POINT": ".",
                    "THOUSANDS_SEP": null,
                    "DECIMALS": "2",
                    "THOUSANDS_VARIANT": "B",
                    "HIDE_ZERO": "Y"
                }
            }
        },
        "time": {
            "start": 1776512407,
            "finish": 1776512407.667997,
            "duration": 0.667996883392334,
            "processing": 0,
            "date_start": "2026-04-18T14:40:07+03:00",
            "date_finish": "2026-04-18T14:40:07+03:00"
        }
    },
    "query": {
        "method": "crm.currency.get",
        "data": {
            "id": "RUB"
        },
        "endpoint": "/rest",
        "queryParams": "",
        "cors": false
    },
    "status": 200
}
```
