# ORM в инфоблоках

## Join таблицы с инфоблоком и фильтром по свойству с типом Перечисление

```php
ActivityPlanTable::query()
			->setSelect([
				'PLAN_DATE',
				'PLAN_SECONDS',
				'USER_ID',
				'ABSENCE_CODE' => 'ABSENCE.ABSENCE_TYPE.ITEM.XML_ID',
			])
			->whereIn('USER_ID', $this->userIds)
			->where('ACTIVITY_TYPE_ID', 1)
			->whereBetween('PLAN_DATE', $dateFrom, $dateTo)
			->setOrder(['PLAN_DATE' => 'ASC', 'PLAN_SECONDS' => 'DESC'])
			->fetchAll();
```
