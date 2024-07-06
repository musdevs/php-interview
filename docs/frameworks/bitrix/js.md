# JavaScript в Битрикс

## [Получение списка всех событий в системе](https://dev.1c-bitrix.ru/api_help/js_lib/kernel/castom_events/bx_addcustomevent.php)


```javascript
// /bitrix/js/main/core/core.js
function onCustomEvent(eventObject, eventName, eventParams, secureParams) {
    console.log('onCustomEvent', eventName, eventParams, eventObject, secureParams)
    ...
}
```

## Изменение содержимого ячейки таблицы задач

```php
// /bitrix/php_interface/init.php

\Bitrix\Main\EventManager::getInstance()->addEventHandler('main', 'onProlog', function () {
	// Проверить, что текущая страница является списком задач пользователя или проекта

	$engine = new \CComponentEngine();

	$templates = [
		'user_task_list' => 'company/personal/user/#user_id#/tasks/',
		'group_task_list' => 'workgroups/group/#group_id#/tasks/',
	];

	$page = $engine->guessComponentPath(
		'/',
		$templates,
		$variables
	);

	if ($page === 'user_task_list' || $page === 'group_task_list') {
		$assetManager = \Bitrix\Main\Page\Asset::getInstance();
		$assetManager->addJs('/bitrix/js/dexika.corr/tasks.list.js');
	}
});
```

```javascript
// /bitrix/js/dexika.corr/tasks.list.js

BX.ready(function () {
	// Найти в таблице задач колонку пользовательского свойства UF_DEXIKA_CORR_DOC
	let th = document.querySelector('th.main-grid-cell-head[data-name=UF_DEXIKA_CORR_DOC]');

	if (!th) {
		return
	}

	// Найти родительский тег table
	let table = th.closest('table')

	if (!table) {
		return
	}

	let docs = new Map();

	table.querySelectorAll('td').forEach(cell => {
		if (cell.cellIndex === th.cellIndex) {
			let data = cell.querySelector('.main-grid-cell-inner span')

			if (data && data.innerHTML) {
				let id = Number(data.innerHTML)

				// Запомнить ID документа, если он не пустой
				if (id > 0) {
					docs.set(id, data)
				}
			}
		}
	})

	if (docs.size) {
		docs.forEach(doc => {
			// Изменить содержимое ячейки
			doc.innerHTML = doc.innerHTML + ' Extended...'
		})
	}
})
```
