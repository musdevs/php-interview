# Bitrix REST API

## Программное создание веб-хука

```php
$result = \Bitrix\Rest\APAuth\PasswordTable::add(
	array(
		'USER_ID' => $USER->getId(),
		'PASSWORD' => \Bitrix\Rest\APAuth\PasswordTable::generatePassword(),
		'DATE_CREATE' => new \Bitrix\Main\Type\DateTime(),
		'TITLE' => 'Интеграция с Битрикс24',
		'COMMENT' => '',
	)
);

$password = \Bitrix\Rest\APAuth\PasswordTable::getRowById($result->getId());

$url = '/rest/' . $password['USER_ID'] . '/' . $password['PASSWORD'] . '/module.entity.method';

echo $url, PHP_EOL;

$scope = 'myscope';
$passwordId = $result->getId();

$result = \Bitrix\Rest\APAuth\PermissionTable::add(array(
	'PASSWORD_ID' => $passwordId,
	'PERM' => $scope,
));

```

## Получение доступа для внешнего серверного приложения

refresh_token сохраняет свою актуальность в течение 28 дней

## Обращение через веб-хук
curl --insecure -d "taskId=1" -X POST https://dwp-test.maytea.com/rest/5555/afjdpasdkfja;sd/tasks.task.get

## Ссылки
- [Документация по REST](https://dev.1c-bitrix.ru/rest_help/index.php)
- [Приложения Битрикс24](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=99&INDEX=Y)
- [Полный протокол OAuth 2.0](https://dev.1c-bitrix.ru/learning/course/?COURSE_ID=99&LESSON_ID=2486&LESSON_PATH=8771.5380.5379.2486)
- [Как внешнее приложение может продлять авторизацию без участия пользователя?](https://dev.1c-bitrix.ru/community/blogs/b24_marketplace/8324.php)
- [Кастомная авторизация Приложений24 в коробке](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=99&CHAPTER_ID=05074&LESSON_PATH=8771.5380.5074)
- [Приложения под колпаком или как работать с параноиками](https://youtu.be/MtTVF9Vf0Wo)
- [Автоматическое продление авторизации OAuth 2.0](https://dev.1c-bitrix.ru/learning/course/?COURSE_ID=99&LESSON_ID=10263)
- [Веб-хуки](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=99&LESSON_ID=8581)
- [https://github.com/mesilov/bitrix24-php-sdk](https://github.com/mesilov/bitrix24-php-sdk)
- [Битрикс24 приложение на Symfony](https://verstaem.com/bitrix24/cloud-app-on-symfony/)
- [Bitrix24 API - разбор демо приложения третьего типа](http://ekhlakov.blogspot.com/2015/09/bitrix24-api.html)
- [Маркетплейс Битрикс24](https://academy.1c-bitrix.ru/education/index.php?COURSE_ID=88)
- [Создание приложения для Bitrix24 с нуля](https://habr.com/ru/post/459012/)