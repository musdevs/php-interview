# Меню Битрикс24

## Теория

- Контроллер, который сохраняет пункты меню: \Bitrix\Intranet\Controller\LeftMenu
- [How-to: свой пункт меню со счетчиком в коробочной версии](https://zen.yandex.ru/media/id/5d358086f0d4f400adf3aa61/howto-svoi-punkt-meniu-so-schetchikom-v-korobochnoi-versii-5e95b7bd0a471779a8546ef0)
- [Делаем свое меню со счетчиками в Битрикс24](https://dev.1c-bitrix.ru/community/blogs/antonds/make-your-menu-with-counters-in-bitrix24.php)

## Добавление в меню текущему пользователю (в таблице b_user_option)

```php
$optionName = 'left_menu_standard_items_s1';
$menuItems = \CUserOptions::GetOption('intranet', $optionName);

if (!is_array($menuItems)) {
	$menuItems = [];
}

$menuItems['some_menu_id'] = [
	'ID' => 'some_menu_id',
	'TEXT' => 'Мой пункт меню',
	'LINK' => '/some/page/',
	'COUNTER_ID' => 'my_counter_id',
];

\CUserOptions::SetOption('intranet', $optionName, $menuItems);
```

## Добавление в меню всем пользователям (в таблице b_option_site)

```php
$optionName = 'left_menu_items_to_all_s1';
$menuItems = unserialize(\Bitrix\Main\Config\Option::get('intranet', 'left_menu_items_to_all_s1', '', 's1'));

if (!is_array($menuItems)) {
	$menuItems = [];
}

$menuItems['some_menu_id'] = [
	'ID' => 'some_menu_id',
	'TEXT' => 'Мой пункт меню',
	'LINK' => '/some/page/',
	'COUNTER_ID' => 'my_counter_id',
];

\Bitrix\Main\Config\Option::set('intranet', 'left_menu_items_to_all_s1', serialize($menuItems), 's1');
```

## [Построение и показ меню](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=43&LESSON_ID=3254)

```php
Array
(
	[0] => пункт меню 1
		Array
			(
				[0] => заголовок пункта
				[1] => ссылка на пункте
				[2] => массив дополнительных ссылок для подсветки пункта:
					Array
						(
							[0] => ссылка 1
							[1] => ссылка 2
							...
						)
				[3] => массив дополнительных переменных передаваемых в шаблон меню:
					Array
						(
							[имя переменной 1] => значение переменной 1
							[имя переменной 2] => значение переменной 2
							...
						)
				[4] => условие, при котором пункт появляется
					это PHP выражение, которое должно вернуть "true"
			)
	[1] => пункт 2
	[2] => пункт 3
	...
)
```

## Выводить пункт меню только для админов

```php
<?php
// .left.menu.php
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

$aMenuLinks = [
	[
	[
		'Мой модуль',
		SITE_DIR.'my/module/',
		[],
		[],
		''
	],
	[
		'Настройки',
		SITE_DIR.'my/module/settings/',
		[],
		[],
		'\Bitrix\Main\Loader::includeModule("my.module") && \My\Module\Module::hasAdminRole()',
	],
];
```
