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
