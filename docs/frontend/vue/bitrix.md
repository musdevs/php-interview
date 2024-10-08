# Vue.js в Битрикс

[Руководство на русском](https://ru.vuejs.org/v2/guide/)
[BitrixVue 2](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=176&CHAPTER_ID=024504&LESSON_PATH=16866.24504)
[Расширения (extensions) Битрикс](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=43&LESSON_ID=11981&LESSON_PATH=3913.3516.4776.3635.11981)
[Инструмент @bitrix/cli](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=43&LESSON_ID=12435&LESSON_PATH=3913.3516.4776.3635.12435)


[Пример готового Vue-приложения taskmanager](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=176&LESSON_ID=24510&LESSON_PATH=16866.24504.24508.24510)
[Скачать](https://dev.1c-bitrix.ru/docs/chm_files/vue2/taskmanager.zip)

## Примеры компонентов

### im.conference.edit

#### template.php

```php
<?php

?>
	<div id="im-conference-create-fields"></div>
<script>
	BX.ready(function(){
		new BX.Messenger.PhpComponent.ConferenceEdit(<?=Json::encode(
			[
				'id' => $arParams['ID'],
			]
		)?>);
	});
</script>
```
#### script.es6.js

```javascript
import {Reflection, Type} from 'main.core';
import {Vue} from "ui.vue";
import 'im.component.conference.conference-edit';

const namespace = Reflection.namespace('BX.Messenger.PhpComponent');

class ConferenceEdit
{
	gridId = 'CONFERENCE_LIST_GRID';

	constructor(params)
	{
		this.id = params.id || 0;

        // ...

		this.formContainer = document.getElementById("im-conference-create-fields");

		this.init();
	}

	init()
	{
		this.initComponent();
	}

	initComponent()
	{
		Vue.create({
			el: this.formContainer,
			data: () =>
			{
				return {
					conferenceId: this.id,

					// ...

				};
			},
			template: `
				<bx-im-component-conference-edit
					:conferenceId="conferenceId"
					<!-- ... -->
				/>
			`,
		});
	}
}

namespace.ConferenceEdit = ConferenceEdit;
```

#### Расширение conference-edit

```
tree bitrix/js/im/component/conference/conference-edit/
bitrix/js/im/component/conference/conference-edit/
├── bundle.config.js
├── config.php
├── dist
│         ├── conference-edit.bundle.js
└── src
    ├── conference-edit.js
    └── fields
        ├── broadcast.js
        ├── invitation.js
        ├── password.js
        ├── planner.js
        └── title.js
```
