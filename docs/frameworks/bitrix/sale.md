# 


### Получить данные товара

```php
\Bitrix\Main\Loader::includeModule('sale');

$productId = 1000;

$result = \Bitrix\Catalog\ProductTable::getList(array(
	'filter' => array('=ID'=>$productId),
	'select' => array(
		'ID',
		'NAME'=>'IBLOCK_ELEMENT.NAME',
		'CODE'=>'IBLOCK_ELEMENT.CODE',
		'XML_ID'=>'IBLOCK_ELEMENT.XML_ID',
	),
));

if($product=$result->fetch()){
    print_r($product);
}
```

## Ссылки
* [Работа с элементами инфоблока](https://www.tichiy.ru/wiki/rabota-s-catalogelement-i-torgovymi-predlozheniyami-v-bitriks)
* [Работа с товарами каталога](https://estrin.pw/bitrix-d7-snippets/s/producttable/) 
* D7
  * [ProductTable](https://dev.1c-bitrix.ru/api_d7/bitrix/catalog/producttable/index.php)
* [CCatalogProduct::GetList](https://dev.1c-bitrix.ru/api_help/catalog/classes/ccatalogproduct/ccatalogproduct__getlist.971a2b70.php)