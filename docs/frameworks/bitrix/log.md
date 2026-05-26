
## Логгер с датой и контекстом

```php
if (!defined('my_logger')) {
	function my_logger($message, $context = [])
	{
		static $logger;

		if (!$logger) {
			$logger = new \Bitrix\Main\Diag\FileLogger(\Bitrix\Main\Application::getDocumentRoot() . '/bitrix/__tmp.log');
		}

		$logger->setFormatter(new class implements \Bitrix\Main\Diag\LogFormatterInterface {
			public function format($message, array $context = []): string
			{
				// Формат: [2024-01-15 10:30:45] LEVEL: message {context}
				$date = date('Y-m-d H:i:s');

				// Извлекаем уровень из контекста (если передан)
				$level = $context['level'] ?? 'INFO';
				unset($context['level']);

				// Формируем строку контекста
				$contextStr = !empty($context) ? ' ' . json_encode($context, JSON_UNESCAPED_UNICODE) : '';

				return sprintf("[%s] %s: %s%s\n", $date, $level, $message, $contextStr);
			}
		});

		$logger->info($message, $context);
	}
}

my_logger('hello+++');
```
