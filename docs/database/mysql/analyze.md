# Пример анализа проблем с производительностью
``

Анализируем нагрузку на сервер:

```
top

top - 11:37:16 up 263 days, 14:58,  7 users,  load average: 44,88, 42,31, 41,32
Tasks: 874 total,  40 running, 768 sleeping,   9 stopped,  57 zombie
%Cpu(s): 92,9 us,  6,5 sy,  0,0 ni,  0,0 id,  0,0 wa,  0,0 hi,  0,5 si,  0,0 st
KiB Mem : 36907548 total,   327676 free, 30098700 used,  6481172 buff/cache
KiB Swap:        0 total,        0 free,        0 used.  1290264 avail Mem

  PID USER      PR  NI    VIRT    RES    SHR S  %CPU %MEM     TIME+ COMMAND
 3560 mysql     20   0   24,2g  15,0g   5888 S 133,3 42,6   3790:15 mysqld
```

Видим, что процессор перегружен MySQL

Вывести исполняющиеся запросы с помощью mytop

```
mytop
```

```
MySQL on localhost (5.7.26-29)                                                                                                                                                           up 1+00:29:43 [11:32:06]
 Queries: 109.1M  qps: 1297 Slow:    14.0         Se/In/Up/De(%):    68/14/08/05
             qps now: 1014 Slow qps: 0.0  Threads:   31 (   5/  65) 58/20/09/07
 Cache Hits: 48.2M Hits/s: 573.7 Hits now: 386.9  Ratio: 65.1% Ratio now: 66.3%
 Key Efficiency: 50.0%  Bps in/out: 707.4k/ 1.7M   Now in/out: 397.0k/956.2k

      Id      User         Host/IP         DB      Time    Cmd Query or State
       --      ----         -------         --      ----    --- ----------
   569301      root       localhost      mysql         0  Query show full processlist
   587683   bitrix0       localhost sitemanage         0  Query SELECT `price_agreements`.`ID` AS `ID`, `price_agreements`.`UF_DATE_ACTIVE_FROM` AS `UF_DATE_ACTIVE_FROM`, `price_agreements`.`UF_DATE_ACTIVE_TO`
   606566   bitrix0       localhost sitemanage         0  Query SELECT L.ID as ID, L.TITLE as TITLE, L.TYPE_ID as TYPE_ID, L.STAGE_ID as STAGE_ID, L.PROBABILITY as PROBABILITY, L.CURRENCY_ID as CURRENCY_ID, L.
```

Нажимаем f на проблемном запросе

```
Full query for which thread id: 569301
```

Появляется экран
```
Thread 587683 was executing following query:

SELECT `price_agreements`.`ID` AS `ID`, `price_agreements`.`UF_DATE_ACTIVE_FROM` AS `UF_DATE_ACTIVE_FROM`, `price_agreements`.`UF_DATE_ACTIVE_TO` AS `UF_DATE_ACTIVE_TO`, `price_agreements`.`UF_PRICE` AS `UF_PRICE`, `price_agreements`.`UF_PRODUCT_ID` AS `UF_PRODUCT_ID`, `price_agreements`.`UF_ADDRESS_ID` AS `UF_ADDRESS_ID`, `price_agreements`.`UF_XML_ID` AS `UF_XML_ID`, `price_agreements`.`UF_CHANGED_AT` AS `UF_CHANGED_AT`, `price_agreements`.`UF_ACTIVE` AS `UF_ACTIVE`, `price_agreements`.`UF_MULTIPLICITY` AS `UF_MULTIPLICITY`, `price_agreements`.`UF_COMPANY_ID` AS `UF_COMPANY_ID`, `price_agreements`.`UF_ACTION` AS `UF_ACTION`, `price_agreements`.`UF_STATUS_SKU` AS `UF_STATUS_SKU`, `price_agreements`.`UF_RANGE_MML` AS `UF_RANGE_MML`, `price_agreements`.`UF_UNIT_PRICE` AS `UF_UNIT_PRICE`, `price_agreements`.`UF_FLAVOR_ORDER` AS `UF_FLAVOR_ORDER`FROM `mcart_price_agreements` `price_agreements` WHERE ( UPPER(`price_agreements`.`UF_XML_ID`) like upper('100438_15840') AND `price_agreements`.`UF_DATE_ACTIVE_FROM` = '2020-10-30 00:00:00' AND `price_agreements`.`UF_DATE_ACTIVE_TO` = '1900-01-01 00:00:00' AND `price_agreements`.`UF_ADDRESS_ID` = 36560347 AND `price_agreements`.`UF_COMPANY_ID` = '2212' AND `price_agreements`.`UF_PRODUCT_ID` = 11378874)LIMIT 0, 1

```

Нажимаем e

```
EXPLAIN SELECT `price_agreements`.`ID` AS `ID`, `price_agreements`.`UF_DATE_ACTIVE_FROM` AS `UF_DATE_ACTIVE_FROM`, `price_agreements`.`UF_DATE_ACTIVE_TO` AS `UF_DATE_ACTIVE_TO`, `price_agreements`.`UF_PRICE` AS `UF_PRICE`, `price_agreements`.`UF_PRODUCT_ID` AS `UF_PRODUCT_ID`, `price_agreements`.`UF_ADDRESS_ID` AS `UF_ADDRESS_ID`, `price_agreements`.`UF_XML_ID` AS `UF_XML_ID`, `price_agreements`.`UF_CHANGED_AT` AS `UF_CHANGED_AT`, `price_agreements`.`UF_ACTIVE` AS `UF_ACTIVE`, `price_agreements`.`UF_MULTIPLICITY` AS `UF_MULTIPLICITY`, `price_agreements`.`UF_COMPANY_ID` AS `UF_COMPANY_ID`, `price_agreements`.`UF_ACTION` AS `UF_ACTION`, `price_agreements`.`UF_STATUS_SKU` AS `UF_STATUS_SKU`, `price_agreements`.`UF_RANGE_MML` AS `UF_RANGE_MML`, `price_agreements`.`UF_UNIT_PRICE` AS `UF_UNIT_PRICE`, `price_agreements`.`UF_FLAVOR_ORDER` AS `UF_FLAVOR_ORDER`FROM `mcart_price_agreements` `price_agreements` WHERE ( UPPER(`price_agreements`.`UF_XML_ID`) like upper('100438_15840') AND `price_agreements`.`UF_DATE_ACTIVE_FROM` = '2020-10-30 00:00:00' AND `price_agreements`.`UF_DATE_ACTIVE_TO` = '1900-01-01 00:00:00' AND `price_agreements`.`UF_ADDRESS_ID` = 36560347 AND `price_agreements`.`UF_COMPANY_ID` = '2212' AND `price_agreements`.`UF_PRODUCT_ID` = 11378874)LIMIT 0, 1:

*** row 1 ***
          table:  price_agreements
           type:  ALL
  possible_keys:  NULL
            key:  NULL
        key_len:  NULL
            ref:  NULL
           rows:  256321
          Extra:  Using where
```

Видим, что не используется индекс ((
