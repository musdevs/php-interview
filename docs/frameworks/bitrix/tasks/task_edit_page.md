# Страница редактирования задачи

## Блок пользовательских полей

Поля выводятся в компоненте tasks.userfield.panel

Если нужно убрать кнопки удаления/скрытия полей, то на странице добавить код

```javascript
(function () {
	'use strict';

	if (typeof BX === 'undefined') {
		return;
	}

	BX.ready(function () {
		const panels = document.querySelectorAll('.tasks-uf-panel-row-buttons')
		panels.forEach((panel) => {
			// скрытие кнопок удаления и изменения пользовательских полей в задаче в режиме редактирования
			panel.innerHTML = ''
		})
	});
})();
```
