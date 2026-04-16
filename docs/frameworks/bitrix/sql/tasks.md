# SQL-запросы по задачам

## Задачи в проектах с пользовательскими полями

```sql
select
  g.id as event_id,
  g.name as event_name,
  concat(u.LAST_NAME, ' ', u.NAME, ' ', u.SECOND_NAME) as event_manager,
  u.uf_department,
  g.PROJECT_DATE_START,
  g.PROJECT_DATE_FINISH,
  t.id as task_id,
  t.title as task_title,
  t.UF_ANALYTICS_ETAP as task_etap,
  t.RESPONSIBLE as task_responsible
,START_DATE_PLAN
,END_DATE_PLAN
from b_sonet_group g
left join (
select u.id
, u.last_name
, u.name
, u.second_name
, uts.uf_department
from b_user u
inner join b_uts_user uts on uts.value_id=u.id) u on g.owner_id=u.id
left join (
SELECT t.id
, t.title
, t.parent_id
, t.group_id
, uts.UF_ANALYTICS_ETAP
, concat(u.LAST_NAME, ' ', u.NAME, ' ', u.SECOND_NAME) as RESPONSIBLE
,START_DATE_PLAN
,END_DATE_PLAN
FROM b_tasks t
inner join b_uts_tasks_task uts on uts.value_id=t.id
left join b_user u on t.RESPONSIBLE_ID=u.id
where t.group_id > 0
and t.parent_id = 0 or t.parent_id is null
) as t on t.group_id= g.id
```

## Файлы в комментариях задач

Для задачи с ID=202291

```sql
select f.ID, f.ORIGINAL_NAME, f.SUBDIR, f.FILE_NAME
from b_file f
       inner join b_disk_object o on o.FILE_ID = f.ID
       inner join b_disk_attached_object a on a.OBJECT_ID = o.ID
       inner join b_forum_message m on a.ENTITY_ID = m.ID
where m.XML_ID='TASK_202291';
```

```
+------+----------------+--------+------------------------------------+
|ID    |ORIGINAL_NAME   |SUBDIR  |FILE_NAME                           |
+------+----------------+--------+------------------------------------+
|151484|Приказ №1.odt   |disk/785|vqoax27nlavfcffonk0hwf4lr2x5m2ik.odt|
|151485|Входящий №25.odt|disk/045|ynvqvlii95rcpvzwjxdcn72ae2uvoamg.odt|
+------+----------------+--------+------------------------------------+
```

## Файл в задаче, помеченный как результат

```sql
select f.ID, f.ORIGINAL_NAME, f.SUBDIR, f.FILE_NAME
from b_file f
         inner join b_disk_object o on o.FILE_ID = f.ID
         inner join b_disk_attached_object a on a.OBJECT_ID = o.ID
         inner join b_forum_message m on a.ENTITY_ID = m.ID
         inner join b_tasks_result r on r.COMMENT_ID = m.ID
where r.TASK_ID=36;
```

```
+-------------+----------------------------------------------------+
|ID           |333                                                 |
+-------------+----------------------------------------------------+
|ORIGINAL_NAME|Договор.docx                                        |
+-------------+----------------------------------------------------+
|SUBDIR       |dexika/contract/7ef/ucb6o0ik5ykd31e5g0frx84cc3fi7ppl|
+-------------+----------------------------------------------------+
|FILE_NAME    |Договор.docx                                        |
+-------------+----------------------------------------------------+
```
