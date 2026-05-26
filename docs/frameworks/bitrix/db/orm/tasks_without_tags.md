# Получить все задачи, у которых нет тега 'Тест'

```php
<?php

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
echo '<pre>';

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Query\Join;
use Bitrix\Tasks\Internals\Task\LabelTable;
use Bitrix\Tasks\Internals\Task\TaskTagTable;
use Bitrix\Tasks\TaskTable;

Loader::includeModule('tasks');

$groupId = 21;

$tracker = Application::getConnection()->startTracker();

$query = TaskTable::query()
	->setSelect([
		'ID',
		'TITLE',
		'DESCRIPTION',
		'DEADLINE',
		'START_DATE_PLAN',
		'END_DATE_PLAN',
		'CREATED_BY',
		'PARENT_ID',
		'RESPONSIBLE_ID',
		'RESPONSIBLE_LAST_NAME' => 'RESPONSIBLE.LAST_NAME',
		'RESPONSIBLE_NAME' => 'RESPONSIBLE.NAME',
		'RESPONSIBLE_SECOND_NAME' => 'RESPONSIBLE.SECOND_NAME',
		'RESPONSIBLE_WORK_POSITION' => 'RESPONSIBLE.WORK_POSITION',
		'MEMBER_ID' => 'MEMBER_LIST.USER_ID',
		'MEMBER_LAST_NAME' => 'MEMBER_LIST.USER.LAST_NAME',
		'MEMBER_NAME' => 'MEMBER_LIST.USER.NAME',
		'MEMBER_SECOND_NAME' => 'MEMBER_LIST.USER.SECOND_NAME',
		'MEMBER_WORK_POSITION' => 'MEMBER_LIST.USER.WORK_POSITION',
		'MEMBER_TYPE' => 'MEMBER_LIST.TYPE',
	])
	->where('GROUP_ID', $groupId)
	->whereNotExists(
		// Подзапрос: находим задачи, у которых есть тег 'ВПД'
		TaskTagTable::query()
			->registerRuntimeField('TAG_LABEL_SUB', new Reference(
				'TAG_LABEL_SUB',
				LabelTable::class,
				Join::on('this.TAG_ID', 'ref.ID')
			))
			->where('TAG_LABEL_SUB.NAME', 'Тест')
			->whereColumn('TASK_ID', 'ID')
	)
	->setOrder('TITLE');

$r = $query->exec()->fetchAll();

var_dump($r);
echo '</pre>';
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
```
