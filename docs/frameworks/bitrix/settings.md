# Настройка Битркикс

## Принудительное включение https в ядре

Если не корректно настроен хостинг, то можно принудительно [сказать](https://divasoft.ru/blog/prinuditelnoe-vklyuchenie-https-v-yadre-1s-bitriks/) битриксу, что ядро работает по https.
Для этого создаём/редактируем файл bitrix/.settings_extra.php

```php
<?php
return array (
  "https_request" => array("value" => true),
);
 ?>
```

```php
<?php
return array(
	'cache_flags' =>
		array(
			'value' =>
				array(
					'config_options' => 3600.0,
				),
			'readonly' => false,
		),
	'cookies' =>
		array(
			'value' =>
				array(
					'secure' => true,
					'http_only' => true,
				),
			'readonly' => false,
		),
	'exception_handling' =>
		array(
			'value' =>
				array(
					'debug' => true,
					'handled_errors_types' => 4437,
					'exception_errors_types' => 4437,
					'ignore_silence' => false,
					'assertion_throws_exception' => true,
					'assertion_error_type' => 256,
					'log' => array(
						'settings' => array(
							'file' => 'bitrix/php_interface/exception.log',
							'log_size' => 1000000,
						),
					),
				),
			'readonly' => false,
		),
	'connections' =>
		array(
			'value' =>
				array(
					'default' =>
						array(
							'host' => 'db',
							'database' => 'bitrix',
							'login' => 'user',
							'password' => 'secret',
							'options' => 2.0,
							'className' => '\\Bitrix\\Main\\DB\\PgsqlConnection',
//							'className' => '\\Bitrix\\Main\\DB\\MysqliConnection',
							'charset' => 'utf-8',
							'include_after_connected' => '',
						),
				),
			'readonly' => true,
		),
	'crypto' =>
		array(
			'value' =>
				array(
					'crypto_key' => 'a51bfb3a0a0002d3286a9077ba328453',
				),
			'readonly' => true,
		),
	'composer' => array(
		'value' => array(
			'config_path' => __DIR__ . '/../local/composer.json',
		),
	),
	// включить/отключить редиректы на HTTPS
	'https_request' => array(
		'value' => false
	),
);
```
