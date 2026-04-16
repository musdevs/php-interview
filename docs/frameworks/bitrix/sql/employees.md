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

## -- Вся оргструктура

```sql
select s.ID   as department_id
     , s.NAME as department_name
     , s.IBLOCK_SECTION_ID
     , s.LEFT_MARGIN
     , s.RIGHT_MARGIN
     , s.DEPTH_LEVEL
     , s.SORT
     , us.UF_HEAD
     , u.LAST_NAME
from b_iblock_section s
         inner join b_uts_iblock_3_section us on us.VALUE_ID = s.ID
         left join b_user u on u.ID = us.UF_HEAD
where s.IBLOCK_ID = 3
order by LEFT_MARGIN;
```

## Список подразделений, которыми руководит сотрудник

```sql
select s.ID   as department_id
     , s.NAME as department_name
from b_iblock_section s
         inner join b_uts_iblock_3_section us on us.VALUE_ID = s.ID
where s.IBLOCK_ID = 3
  and us.UF_HEAD = 2198;
```

## Кто руководит не одним подразделением

```sql
select VALUE_ID, UF_HEAD
from b_uts_iblock_3_section
where UF_HEAD in (select UF_HEAD
                  from b_uts_iblock_3_section
                  group by UF_HEAD
                  having count(UF_HEAD) > 1);
```

## Все ID подразделений, в которых работает сотрудник или руководит

```sql
select VALUE_ID
from b_uts_iblock_3_section
where UF_HEAD = 2198
union
select um.VALUE_INT
from b_utm_user um
         inner join b_user_field f on f.ID = um.FIELD_ID
where um.VALUE_ID = 2198
  and f.FIELD_NAME = 'UF_DEPARTMENT'
  and f.ENTITY_ID = 'USER';
```

## Иерархия от условия

```sql
with recursive departments as (select ID, NAME, DEPTH_LEVEL
                               from b_iblock_section
                               where IBLOCK_ID = 3
                                 -- and IBLOCK_SECTION_ID is null -- с вершины иерархии
                                 -- and ID = 372 -- с выбранного подразделения
                                 -- and ID in (select VALUE_ID from b_uts_iblock_3_section where UF_HEAD = 1875) -- от руководителя
                                 and ID in (select VALUE_ID -- подразделения, которыми руководит сотрудник
                                            from b_uts_iblock_3_section
                                            where UF_HEAD = 2198
                                            union
                                            select um.VALUE_INT -- подразделения, где работает сотрудник
                                            from b_utm_user um
                                                   inner join b_user_field f on f.ID = um.FIELD_ID
                                            where um.VALUE_ID = 2198
                                              and f.FIELD_NAME = 'UF_DEPARTMENT'
                                              and f.ENTITY_ID = 'USER')
                               union all
                               select s1.ID, s1.NAME, s1.DEPTH_LEVEL
                               from b_iblock_section s1
                                      inner join departments s2 on s1.IBLOCK_SECTION_ID = s2.ID
                               where s1.IBLOCK_ID = 3
                                 and s1.ACTIVE = 'Y')
select s.ID
     , s.NAME
     , s.DEPTH_LEVEL
     , u.ID                                                 as USER_ID
     , CONCAT(u.LAST_NAME, ' ', u.NAME, ' ', u.SECOND_NAME) as USER_FULL_NAME
     , u.WORK_POSITION
from departments s
       inner join b_utm_user um on um.VALUE_INT = s.ID
       inner join b_user_field f on f.ID = um.FIELD_ID
       inner join b_user u on u.ID = um.VALUE_ID
where f.FIELD_NAME = 'UF_DEPARTMENT'
  and f.ENTITY_ID = 'USER'
  and u.ACTIVE = 'Y'
order by s.DEPTH_LEVEL, s.NAME;
```
