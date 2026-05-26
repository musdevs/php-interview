# Структура таблиц модуля Задачи

## Задачи - b_tasks

ID - ID задачи
GROUP_ID - ID Проекта
TITLE - Наименование задачи
CREATED_BY - ID постановщика
RESPONSIBLE_ID - ID исполнителя
STATUS - Статус исполнения
DEADLINE - Крайний срок
END_DATE_PLAN - Планируемая дата завершения
START_DATE_PLAN - Дата начала

```sql
select ID,
       GROUP_ID,
       TITLE,
       CREATED_BY,
       RESPONSIBLE_ID,
       STATUS,
       DEADLINE,
       END_DATE_PLAN,
       START_DATE_PLAN
from b_tasks
```

## Роли в задачах - b_tasks_member

TASK_ID - ID задачи
USER_ID - ID сотрудника
TYPE - тип роли (A - соисполнитель)

b_tasks_member.TASK_ID = b_tasks.ID
b_tasks_member.USER_ID = b_user.ID

```sql
select TASK_ID,
       USER_ID,
       TYPE
from b_tasks_member
where TYPE = 'A'
```

```sql
select t.ID,
       t.TITLE,
       u.LAST_NAME,
       u.NAME,
       u.SECOND_NAME
from b_tasks_member m
         inner join b_user u on u.ID = m.USER_ID
         inner join b_tasks t on t.ID = m.TASK_ID
where TYPE = 'A'
```

## Сотрудники - b_user

ID
LAST_NAME - фамилия
NAME - имя
SECOND_NAME - отчество
WORK_POSITION - должность

```
select u.ID,
       u.LAST_NAME,
       u.NAME,
       u.SECOND_NAME
from join b_user u
```

## Пользовательские поля задачи - b_uts_tasks_task

VALUE_ID - ID задачи
UF_ANALYTICS_STAGE - ID элемента инфоблока с этапом (IBLOCK_ID=19)
UF_ANALYTICS_CODE - ID элемента инфоблока c кодом аналитики  (IBLOCK_ID=18)
UF_ANALYTICS_DIRECTION - ID элемента инфоблока с направлением работы (IBLOCK_ID=21)

b_uts_tasks_task.VALUE_ID=b_tasks.ID
b_uts_tasks_task.UF_ANALYTICS_STAGE=b_iblock_element.ID
b_uts_tasks_task.UF_ANALYTICS_CODE=b_iblock_element.ID
b_uts_tasks_task.UF_ANALYTICS_DIRECTION=b_iblock_element.ID

## Проекты - b_sonet_group

ID - ID проекта
NAME - название
PROJECT_DATE_START - начало
PROJECT_DATE_FINISH - окончание

b_sonet_group.ID=b_tasks.GROUP_ID

```sql
select ID,
       NAME,
       PROJECT_DATE_START,
       PROJECT_DATE_FINISH
from b_sonet_group
```


```sql
select g.ID,
       g.NAME,
       g.PROJECT_DATE_START,
       g.PROJECT_DATE_FINISH,
       e.NAME as 'Вид проекта'
from b_sonet_group g
         left join b_uts_sonet_group ug on ug.VALUE_ID = g.ID
         inner join b_iblock_element e on e.ID = ug.UF_ANALYTICS_EVENT_TYPE;
```

## Пользовательские поля проекта - b_uts_sonet_group

VALUE_ID - ID мероприятия
UF_ANALYTICS_EVENT_TYPE - ID элемента инфоблока c видом мероприятия  (IBLOCK_ID=20)

b_uts_sonet_group.VALUE_ID = b_sonet_group.ID

### Пример видов проекта:

```sql
select ug.VALUE_ID  as 'ID мероприятия',
        ug.UF_ANALYTICS_EVENT_TYPE as 'ID элемента инфоблока c видом мероприятия',
        e.NAME 'Название вида мероприятия'
from b_uts_sonet_group ug
         inner join b_iblock_element e on e.ID = ug.UF_ANALYTICS_EVENT_TYPE;
```

## Множественные пользовательские поля проекта - b_utm_sonet_group

VALUE_ID - ID проекта
UF_ANALYTICS_CODE - ID элемента инфоблока c кодом аналитики  (IBLOCK_ID=18)
UF_OBJECTS - ID CRM-компании

### Пример кодов аналитики для проекта

```sql
select ug.VALUE_ID  as 'ID проекта',
        ug.VALUE_INT as 'ID элемента инфоблока c кодом аналитики',
        e.NAME       as 'Название кода аналитики'
from b_utm_sonet_group ug
         inner join b_user_field f on ug.FIELD_ID = f.ID
         inner join b_iblock_element e on e.ID = ug.VALUE_INT
where f.FIELD_NAME = 'UF_ANALYTICS_CODE'
  and e.IBLOCK_ID = 18;
```

### Пример объектов для проекта

```sql
select ug.VALUE_ID  as 'ID мероприятия',
        ug.VALUE     as 'ID CRM-компании',
        c.TITLE      as 'Объект'
from b_utm_sonet_group ug
         inner join b_user_field f on ug.FIELD_ID = f.ID
         inner join b_crm_company c on c.ID = ug.VALUE
where f.FIELD_NAME = 'UF_OBJECTS';
```

## Элементы инфоблоков - b_iblock_element

ID - ID элемента
IBLOCK_ID - ID инфоблока
NAME - название

```sql
select ID, NAME from b_iblock_element
```

## Компании CRM - b_crm_company
ID - ID компании
TITLE - название

```sql
select ID, TITLE from b_crm_company
```

## Затраченное время - b_tasks_elapsed_time

TASK_ID - ID задачи
USER_ID - ID сотрудника
SECONDS - затраченное время в секундах

b_tasks_elapsed_time.TASK_ID = b_tasks.ID

```sql
select t.ID,
       t.TITLE,
       et.CREATED_DATE,
       et.SECONDS,
       u.LAST_NAME,
       u.NAME,
       u.SECOND_NAME
from b_tasks t
         inner join b_tasks_elapsed_time et on t.ID = et.TASK_ID
         inner join b_user u on et.USER_ID = u.ID
```
