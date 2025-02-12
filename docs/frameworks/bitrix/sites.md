# Модуль Сайты и Магазины

## Проблемы

### При добавлении любого блока из группы CRM-форма в консоли браузера появляется ошибка

Ошибка:
```
Failed to load resource: the server responded with a status of 404 () v0b4xafd8sngfkunra49shp2xo5i3y15.js:1
Failed to load resource: the server responded with a status of 404 () /upload/crm/9e8/v0b4xafd8sngfkunra49shp2xo5i3y15.js?20130:1

Кнопка Редактировать не работает. В консоли ошибка:

block.js:1989 Uncaught TypeError: Cannot read properties of null (reading 'firstChild')
at BX.Landing.Block.getBlockFormId (block.js:1989:39)
at BX.Landing.Block.onShowContentPanel (block.js:2108:22)
```

Ответ ТП:

```
Судя по всему, есть сложности со скриптами форм. Чтобы это исправить, сделайте пожалуйста следующее:
1. Авторизуйтесь на портале по https
2. Проверьте, чтобы в настройках модуля сайты, в графе Адрес портала для публикации, был указан текущий адрес портала, в формате b24.dexika.ru:443
3. Перейдите по такой ссылке https://b24.dexika.ru/crm/webform/?rebuildResources=y - это пересобирёт скрипты форм
4. Выполните очистку файлов кеша для модуля Сайты24 в разделе "Настройки- Настройки продукта - Автокеширование". Вкладка "Очистка файлов кеша" - пункт Сайты24
5. Перейдите по такой ссылке https://b24.dexika.ru/crm/webform/?rebuildAll=y - это переопубликует формы

Это обновить скрипты формы по https и они должны заработать

Проверьте пожалуйста результат в другом браузере. Это важно, т.к. браузер где вы открывали форму до этого, будет ещё какое время отдавать старые скрипты форм из кеша
```


[О REST API в сайтах](https://apidocs.bitrix24.ru/api-reference/landing/index.html)
[Курс: REST API Битрикс24 - Шаблоны сайтов](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=266&LESSON_ID=25504&LESSON_PATH=25398.25498.25504)
[Сайты24 - Документация по D7](https://dev.1c-bitrix.ru/api_d7/bitrix/landing/index.php)
[Контент-менеджер - Работа с модулями (дополнительный материал) - Сайты 24](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=34&CHAPTER_ID=011223&LESSON_PATH=3905.4753.11223)
