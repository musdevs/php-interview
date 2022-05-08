# Логгирование

## Форматирование логов в JSON:

JSON-форматтер
```php
<?php
declare(strict_types = 1);

namespace App\Logging;

use Monolog\Formatter\JsonFormatter as MonologJsonFormatter;
use Monolog\Utils;

class JsonFormatter extends MonologJsonFormatter
{
    public function __invoke($logger)
    {
        foreach ($logger->getHandlers() as $handler) {
            $handler->setFormatter($this);
        }
    }

    protected function toJson($data, $ignoreErrors = false)
    {
        return Utils::jsonEncode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES, $ignoreErrors);
    }
}
```

В конфиг config/logging.php добавить:

```php
'stack' => [
    'driver' => 'stack',
    'channels' => [..., 'dev'],
],
'dev' => [
    'driver' => 'daily',
    'path' => storage_path('logs/dev.log'),
    'tap' => [\App\Logging\JsonFormatter::class],
    'level' => 'debug',
    'days' => 7,
],
```

## Логгирование всех запросов и ответов

local/framework/bootstrap/Bindings/Middlewares.php
```php
 $app->middleware([
     App\Http\Middleware\LoggerMiddleware::class,
     ...
]);

```

Мидлвар:

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class LoggerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Log::channel('dev')->debug('New request', [
            'path' => $request->getPathInfo(),
            'method' => $request->getMethod(),
            'post' => $request->post(),
            'get' => $request->all(),
        ]);
        return $next($request);
    }

    public function terminate($request, $response)
    {
        Log::channel('dev')->debug('Response', [
            $response
        ]);
    }
}
```
