# How-to

## Create artisan command

Generate command class App\Console\Command\Some\Component\MyCommand with signature my:command

```bash
php artisan make:command Some/Component/MyCommand --command=my:command
```

Generate model class App\Model\Category\Item and migration

```bash
php artisan make:model Model/Category/Item -m
```

```php
		// если исключить всех недействующих
//		$query->whereHas('field', function ($q) {
//			$q->where('UF_CRM_MDCUSTSTATUS', '=', 'Действует');
//		});

		// выбрать Статус
		$query->with([
			'contractorFields',
		]);

//		$query->with([
//			'contractor',
//			'field' => function($query) {
//				$query->select('VALUE_ID', 'UF_CRM_MDCUSTSTATUS');
//			}
//		]);
```
