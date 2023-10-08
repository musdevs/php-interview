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

[Пример разработки активити](https://web4.kz/upload/files/7e961031718e49aa235532ab8fe3295f.pdf)
