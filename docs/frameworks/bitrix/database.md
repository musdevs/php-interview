# База данных битрикса

## Выгрузка информации о таблицах в CSV-файл

```php
$sql = 'SELECT * FROM information_schema.TABLES';
$file = $_SERVER['DOCUMENT_ROOT'] . '/upload/tmp/t.csv';

$res = \Bitrix\Main\Application::getConnection()->query($sql)->fetchAll();

if (!$res) {
	echo 'Результат запроса пустой', PHP_EOL;
	return;
}

$fp = fopen($file, 'w');

fputcsv($fp, array_keys($res[0]));

foreach ($res as $row) {
	fputcsv($fp, $row);
}
fclose($fp);

echo file_get_contents($file);
```

## Просмотр лога SQL-запросов

```php
		$connection = \Bitrix\Main\Application::getConnection();
		$tracker = $connection->startTracker();

...
		$connection->stopTracker();

		foreach ($tracker->getQueries() as $query) {
			var_dump($query->getSql());
			var_dump($query->getTime());
        }
```
