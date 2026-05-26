# Бизнес-процесс в Битрикс24

- [Пример разработки активити](https://web4.kz/upload/files/7e961031718e49aa235532ab8fe3295f.pdf)
- [REST в бизнес-процессах](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=57&LESSON_ID=23036&LESSON_PATH=5442.4567.7309.23036)
- [Создание REST aсtivity (действий) Битрикс24 с приложением-встройкой для препроцессинга параметров](https://habr.com/ru/articles/694874/)
- [Курс Бизнес-процессы](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=57&INDEX=Y)
- [Как мы настраивали миграции для бизнес-процессов в Битрикс24](https://habr.com/ru/companies/simbirsoft/articles/466823/)

## Сохранение запустившего БП
```php
global $USER;
$rootActivity = $this->getRootActivity();
$rootActivity->setVariable('bizprocCreator', 'user_' . $USER->GetID());
```

## Запись в журнал бп
```php
    $this->GetRootActivity()->WriteToTrackingService('Тест');
```

## [Создание прямой ссылки на страницу с заданием](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=57&LESSON_ID=3817&LESSON_PATH=5442.5446.5059.3817)

## Конвертировать файл шаблона бизнес-процесса в JSON

```php
<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

$fp = fopen($_SERVER['DOCUMENT_ROOT'] . '/upload/bp-287.bpt', 'r');
$data = fread($fp, 1_000_000);
fclose($fp);

$data = gzuncompress($data);
$data = unserialize($data);

$json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );

$fp = $fp = fopen($_SERVER['DOCUMENT_ROOT'] . '/upload/bp-287.json', 'w');
fwrite($fp, $json);
fclose($fp);


echo '<pre>';
echo($json);
echo '</pre>';
?>
<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>
```

```
[url=https://[адрес_портала]/company/personal/bizproc/{=Workflow:ID}/]ссылка на страницу просмотра документа[/url]
```
## В задании сделать пустую строку между текстом

Добавить переменную в шаблоне EmptyString "Пустая строка", значение = ' ' (1 пробел)

```
{=Variable:EmptyString > printable}
[i]{=Variable:LastUser > friendly}:[/i]
[b]{=Variable:LastComment > printable}[/b]
```

Зеленый
[B][COLOR=#1cae6a]Лимит проверен. {=LIMIT_APPROVAL:LastApproverComment}[/COLOR][/B]

Красный
[B][COLOR=#f2473d] Закупка отменена. {=APPROVAL_CORRECTION:Comments}[/COLOR][/B]

Горизонтальная линия
HorizontalLine
{=System:Eol}- - - - - - - - - - - - - - - - - - - - - - - - {=System:Eol}

Множественная переменная TextOffers
Вывести ее значения, разделенные горизонтальной линией
{{=implode({=Variable:HorizontalLine}, {=Variable:TextOffers})}}

##

[Форма «Вставка значения»](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=57&LESSON_ID=12383&LESSON_PATH=5442.5446.5059.12383)

Список системных значений:

{=Workflow:ID} — идентификатор бизнес-процесса
{=Template:TargetUser} — параметр, в котором содержится идентификатор пользователя, запустившего бизнес-процесс в формате user_[номер_пользователя_в_системе]
{=User:ID} — идентификатор текущего пользователя в формате user_[номер_пользователя_в_системе]
{=System:Now} — текущие дата и время сервера. Для облачных Битрикс24 в зоне RU это часовой пояс UTC+3:00 (Московское время). Для коробочных продуктов — время сервера, на котором установлен продукт
{=System:NowLocal} — текущие дата и время пользователя с учётом его часового пояса
{=System:Date} — текущая дата сервера (без времени)
{=System:Eol} — символ конца строки
{=System:HostUrl} — URL сайта. Подставит значение вида https://mysite.ru. Доступно с версии 22.200.0 модуля Бизнес-процессы

В рамках бизнес-процессов для сделок в CRM воспользуйтесь некоторыми значениями из полей контакта или компании, которые связаны с этой сделкой.

Значения для Контактов:

{=Document:CONTACT_ID} — ID контакта
{=Document:CONTACT_TYPE_ID} — ID типа контакта
{=Document:CONTACT_NAME} — имя контакта
{=Document:CONTACT_SECOND_NAME} — фамилия контакта
{=Document:CONTACT_LAST_NAME} — отчество контакта
{=Document:CONTACT_FULL_NAME} — ФИО контакта
{=Document:CONTACT_ADDRESS} — фактический адрес контакта

Значения для Компаний:

{=Document:COMPANY_ID} — ID компании
{=Document:COMPANY_TITLE} — Название компании
{=Document:COMPANY_INDUSTRY} — ID сферы деятельности
{=Document:COMPANY_REVENUE} — годовой оборот
{=Document:COMPANY_CURRENCY_ID} — ID валюты
{=Document:COMPANY_TYPE} — ID типа компании
{=Document:COMPANY_ADDRESS} — фактический адрес компании
{=Document:COMPANY_BANKING_DETAILS} — банковские реквизиты

## Модификаторы переменных, полей документов и пр.

[Список модификаторов](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=57&LESSON_ID=12407&LESSON_PATH=5442.5446.5059.12407)

Модификатор	Описание

printable	Преобразует значение в понятную пользователю строку. Подходит для данных любого типа данных.
{=Variable:Variable1 > printable}

friendly	Для данных типа Пользователь. Выводит только имя и фамилию пользователя, без его ID и логина.
{=Document:CREATED_BY > friendly}

name	Получает имя файла для полей типа Файл. С версии 20.100.0 модуля Бизнес-процессы.
{=Variable:File > name}

server	Для данных типа Дата и Дата/время. Выводит дату/время в часовом поясе сервера.
{=Variable:Datetime > server}

local	Для данных типа Дата и Дата/время. Выводит дату/время в часовом поясе пользователя.
{=Variable:Datetime > local}

responsible	Для данных типа Дата и Дата/время. Выводит дату/время в часовом поясе Ответственного.
{=Variable:Datetime > responsible}

publink	Для данных типа Файл. Создаёт публичную ссылку на файл. С версии 20.0.700 модуля Бизнес-процессы.
{=Document:PROPERTY_MY_FILE > publink}

shortlink	Для данных типа Файл. Создаёт короткую ссылку на файл. С версии 20.0.700 модуля Бизнес-процессы.
{=Document:PROPERTY_MY_FILE > shortlink}

src	Для данных типа Файл. Создаёт прямую ссылку на файл.
Важно: использование в коробочных версиях продукта небезопасно.
{=Document:PROPERTY_MY_FILE > src}

Модификаторы для преобразования типов данных

bool	Преобразует данные в bool (булевый тип).
{=Variable:Variable1 > bool}

date	Преобразует данные в тип date (дата).
{=Variable:Variable1 > date}

datetime	Преобразует данные в тип datetime (дата/время).
{=Variable:Variable1 > datetime}

double	Преобразует данные в тип double (число).
{=Variable:Variable1 > double}

int	Преобразует данные в тип int (целое число).
{=Variable:Variable1 > int}

file	Преобразует данные в тип file (файл).
{=Variable:Variable1 > file}

select	Преобразует данные в тип select (список).
{=Variable:Variable1 > select}

string	Преобразует данные в тип string (строка).
{=Variable:Variable1 > string}

text	Преобразует данные в тип text (текст).
{=Variable:Variable1 > text}

user	Преобразует данные в тип user (пользователь).
{=Variable:Variable1 > user}


[Функции калькулятора выражений](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=57&LESSON_ID=4912&LESSON_PATH=5442.5446.5059.4912#merge)
[Вычисление значений выражений в параметрах действий](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=57&LESSON_ID=3814&LESSON_PATH=5442.5446.5059.3814)
[Модификация данных](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=57&LESSON_ID=12407&LESSON_PATH=5442.5446.5059.12407)
[Коды подстановки сущностей](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=57&LESSON_ID=13640&LESSON_PATH=5442.5446.5059.13640)
[Мессенджер: форматирование сообщений и горячие клавиши](https://helpdesk.bitrix24.ru/open/22091486/)

## Глобальные переменные

```php
var_dump(\Bitrix\Bizproc\Workflow\Type\GlobalVar::getAll());

array(1) {
  ["Variable1753769240232"]=>
  array(12) {
    ["Name"]=>
    string(16) "Сложение"
    ["Description"]=>
    string(0) ""
    ["Type"]=>
    string(6) "double"
    ["Required"]=>
    bool(false)
    ["Multiple"]=>
    bool(false)
    ["Options"]=>
    string(0) ""
    ["Default"]=>
    float(2)
    ["CreatedBy"]=>
    int(2089)
    ["CreatedDate"]=>
    object(Bitrix\Main\Type\DateTime)#439 (2) {
      ["value":protected]=>
      object(DateTime)#438 (3) {
        ["date"]=>
        string(26) "2025-07-29 09:07:20.000000"
        ["timezone_type"]=>
        int(3)
        ["timezone"]=>
        string(13) "Europe/Moscow"
      }
      ["userTimeEnabled":protected]=>
      bool(true)
    }
    ["Visibility"]=>
    string(6) "GLOBAL"
    ["ModifiedBy"]=>
    int(2089)
    ["ModifiedDate"]=>
    object(Bitrix\Main\Type\DateTime)#437 (2) {
      ["value":protected]=>
      object(DateTime)#436 (3) {
        ["date"]=>
        string(26) "2025-07-29 09:07:20.000000"
        ["timezone_type"]=>
        int(3)
        ["timezone"]=>
        string(13) "Europe/Moscow"
      }
      ["userTimeEnabled":protected]=>
      bool(true)
    }
  }
}
```

```sql
select * from b_bp_global_var;
```

```
+---------------------+--------+-----------+-------------+-----------+-----------+----------------+-----------------+--------------+-------------------+----------+----------+-------------------+-----------+
|ID                   |NAME    |DESCRIPTION|PROPERTY_TYPE|IS_REQUIRED|IS_MULTIPLE|PROPERTY_OPTIONS|PROPERTY_SETTINGS|PROPERTY_VALUE|CREATED_DATE       |CREATED_BY|VISIBILITY|MODIFIED_DATE      |MODIFIED_BY|
+---------------------+--------+-----------+-------------+-----------+-----------+----------------+-----------------+--------------+-------------------+----------+----------+-------------------+-----------+
|Variable1753769240232|Сложение|           |double       |N          |N          |s:0:"";         |null             |d:2;          |2025-07-29 09:07:20|2089      |GLOBAL    |2025-07-29 09:07:20|2089       |
+---------------------+--------+-----------+-------------+-----------+-----------+----------------+-----------------+--------------+-------------------+----------+----------+-------------------+-----------+
```
