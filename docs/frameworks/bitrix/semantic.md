# Использование Semantic UI в Bitrix Framework

## Dropdown с запросом к backend

```html
<div class="ui loading fluid multiple search selection dropdown">
    <input type="hidden" name="group" value="">
    <i class="dropdown icon"></i>
    <input class="search">
    <div class="default text">Поиск...</div>
    <div class="menu">
    </div>
</div>
```

```javascript
$('.ui.dropdown')
    .dropdown({
        apiSettings: {
            url: '/bitrix/services/main/ajax.php?mode=class&c=my.module%3Acomponent.name&action=getListenerCount&q={query}',
            beforeXHR: function (xhr) {
                return xhr;
            },
            beforeSend: function(settings) {
                settings.data.sessid = BX.bitrix_sessid();
                settings.data.SITE_ID = BX.message.SITE_ID;
            }
        },
    })
;
```

```php
use Bitrix\Main\Engine\Contract\Controllerable;

class RouteEdit extends \CBitrixComponent implements Controllerable
{
	public function configureActions()
	{
		return [];
	}

	public function getUserGroupAction()
	{
		return [
			'items' => [
				[
					'name' => 'Администраторы',
					'value' => 1,
				],
				[
					'name' => 'Сотрудники',
					'value' => 2,
				]
			]
		];
	}
}
```

## Ресурсы
1. [Новинки платформы «1С-Битрикс»](https://www.youtube.com/watch?v=6egULFiuTbM&t=15s)
2. [D7 - возможности, практическое применение, текущее развитие и взгляд в будущее. Техноволна 2](https://www.youtube.com/watch?v=1_xYUQzQHj8)
3. [Semantic UI Dropdown](https://semantic-ui.com/modules/dropdown.html)
4. [Semantic UI API](https://semantic-ui.com/behaviors/api.html)
