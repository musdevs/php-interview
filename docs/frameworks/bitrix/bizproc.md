# Бизнес-процесс в Битрикс24

## Сохранение запустивщего БП
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

```
[url=https://[адрес_портала]/company/personal/bizproc/{=Workflow:ID}/]ссылка на страницу просмотра документа[/url]
```

- [Пример разработки активити](https://web4.kz/upload/files/7e961031718e49aa235532ab8fe3295f.pdf)
- [REST в бизнес-процессах](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=57&LESSON_ID=23036&LESSON_PATH=5442.4567.7309.23036)
- [Создание REST aсtivity (действий) Битрикс24 с приложением-встройкой для препроцессинга параметров](https://habr.com/ru/articles/694874/)
- [Курс Бизнес-процессы](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=57&INDEX=Y)
