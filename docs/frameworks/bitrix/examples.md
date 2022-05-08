# Примеры кода

## Инфоблоки

### Получение элемента инфоблока по фильтру

```php
$arFilter = array(
    'IBLOCK_ID' => 3, // выборка элементов из инфоблока с ИД равным «3»
    'ACTIVE' => 'Y',  // выборка только активных элементов
    '>=DATE_ACTIVE_FROM' => '11.11.2021',  
    '<=DATE_ACTIVE_TO' => '13.11.2021',
    'PROPERTY_USER' => 5,  
);

$res = CIBlockElement::GetList(array(), $arFilter, false, false, array('ID','NAME','ACTIVE', 'DATE_ACTIVE_FROM'));

// вывод элементов
if ($element = $res->GetNext()) {
    echo 'ID элемента отсутствия = ' . $element['ID'];
} else {
    echo 'Такое отсутствие не найдено';
}
```