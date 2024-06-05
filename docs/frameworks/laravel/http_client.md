

## Configure the HTTP Client for Container Services

[5 Tips and Tricks for working with the Laravel HTTP Client](https://laravel-news.com/laravel-http-client-tips)

```php
public function register(): void
{
    $this->app->singleton(ExampleService::class, function (Application $app) {
        $client = Http::withOptions([
            'base_uri' => config('services.example.base_url'),
            'timeout' => config('services.example.timeout', 10),
            'connect_timeout' => config('services.example.connect_timeout', 2),
        ])->withToken(config('services.example.token'));

        return new ExampleService($client);
    });
}
```
