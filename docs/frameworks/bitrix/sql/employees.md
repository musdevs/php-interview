# SQL-запросы по сотрудникам

## Сотрудники и подразделения

```sql
select u.id as user_id, u.fio, u.dep_lev1_id, d.name as dep_lev1_name
from
  (
    select
      u.id
         , CONCAT(u.last_name, ' ', u.name, ' ', u.second_name) as fio
         , SUBSTRING_INDEX(SUBSTR(uts.uf_department, 2+LENGTH(SUBSTRING_INDEX(uts.uf_department, ':', 4))), ';', 1) as dep_lev1_id
         , SUBSTRING_INDEX(SUBSTR(uts.uf_department, 2+LENGTH(SUBSTRING_INDEX(uts.uf_department, ':', 6))), ';', 1) as dep_lev2_id
         , uts.uf_department
    from b_user u
           inner join b_uts_user uts on uts.value_id=u.id
  ) u
    inner join b_iblock_section d on d.id=u.dep_lev1_id
where d.iblock_id=3
order by u.fio
```

| user_id | fio                  | dep_id | dep_name      |
|---------|----------------------|--------|---------------|
| 1       | Иванов Иван Иванович | 22     | Отдел закупок |

## Пульс сотрудников за период

```
select
  u.id as user_id
, u.fio
, u.dep_name
, usd.day
, usd.total
from b_intranet_ustat_day usd
inner join (
  select u.id, u.fio, d.name as dep_name
  from
  (
  select
    u.id
  , CONCAT(u.last_name, ' ', u.name, ' ', u.second_name) as fio
  , SUBSTRING_INDEX(SUBSTR(uts.uf_department, 2+LENGTH(SUBSTRING_INDEX(uts.uf_department, ':', 4))), ';', 1) as dep_lev1_id
  , SUBSTRING_INDEX(SUBSTR(uts.uf_department, 2+LENGTH(SUBSTRING_INDEX(uts.uf_department, ':', 6))), ';', 1) as dep_lev2_id
  , uts.uf_department
  from b_user u
  inner join b_uts_user uts on uts.value_id=u.id
  ) u
  inner join b_iblock_section d on d.id=u.dep_lev1_id
  where d.iblock_id=3
) u on u.id = usd.user_id
where
usd.day between '2025-04-01' and '2025-04-16'
order by u.fio
```

| user_id | fio                  | dep_name      | day        | total |
|---------|----------------------|---------------|------------|-------|
| 1       | Иванов Иван Иванович | Отдел закупок | 2025-04-02 | 40    |
