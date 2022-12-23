# GuzzleHttp

## Примеры

### Отладка запросов

```php
$httpClient = new \GuzzleHttp\Client();

$requestParams = [
    'debug' => fopen('/tmp/guzzle.log', 'w+'),
];

$response = $httpClient->request('GET', 'https://api.publicapis.org/entries', $requestParams);

var_dump($response->getBody()->getContents());
```

### Журналирование всех запросов в Laravel

В сервис-контейнере (bootstrap/app.php) добавить:

```php
$app->bind(\GuzzleHttp\Client::class, function($app) {
    return new \GuzzleHttp\Client([
        'debug' => fopen(realpath(storage_path('logs')) . '/guzzle.log', 'w+'),
    ]);
});
```

##

* [Request Options](https://github.com/guzzle/guzzle/blob/6.5/docs/request-options.rst#debug)
