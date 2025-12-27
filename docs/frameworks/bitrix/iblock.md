# Инфоблоки

## ORM

```php
$elementId = 1;
$element = \Bitrix\Iblock\Elements\ElementMyApiCodeTable::getByPrimary($elementId, [
    'select'=> [
        'ID',
        'NAME',
        'IBLOCK_ID',
        'MY_STRING_FIELD',
        'MY_LIST_FIELD',
    ]
])->fetchObject();

// можно так
echo $element->get('MY_STRING_FIELD')->getValue();

// а можно и так
echo $element->getMyStringField()->getValue();

// для списочных вроде как должно работать так, но не работает
echo $element->get('MY_LIST_FIELD')->getItem()->getValue();

// Поэтому для получения значения списка создаем функцию
function fetchPropertyEnumValue($id)
{
    if (!$id) {
        return null;
    }

    $row = \Bitrix\Iblock\PropertyEnumerationTable::query()
        ->where('ID', $id)
        ->setSelect(['VALUE'])
        ->exec()->fetch();

    return $row['VALUE'];
}

echo fetchPropertyEnumValue($element->get('MY_LIST_FIELD')->getValue());
```

## Legacy

### Получить XML_ID типа отсутствия

```php
$res = CIBlockElement::GetProperty(
	1, // ID of the information block
	279638, // ID of the element
	array("sort" => "asc"), // Order for multiple property values (optional)
	array("CODE" => "ABSENCE_TYPE") // Filter by property code
);

var_dump($res->Fetch()['VALUE_XML_ID']);
```


* [РАБОТА С ЭЛЕМЕНТАМИ ИНФОБЛОКОВ В БИТРИКС](https://mrcappuccino.ru/blog/post/iblock-elements-bitrix-d7)
* [Bitrix D7 для инфоблоков](https://blog.budagov.ru/bitrix-d7-dlya-infoblokov/)
* [Элементы инфоблоков, ORM](https://estrin.pw/bitrix-d7-snippets/s/iblock-element-orm/)
* [Интеграция ORM в информационных блоках](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=43&CHAPTER_ID=012864&LESSON_PATH=3913.3516.5748.12864)
