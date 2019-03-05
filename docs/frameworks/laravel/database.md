# Database

## Query Builder

Вывести исполняемый запрос ([см.](https://stackoverflow.com/questions/27753868/how-to-get-the-query-executed-in-laravel-5-dbgetquerylog-returning-empty-ar))
```php
\DB::connection('my')->enableQueryLog();
$result = \DB::connection('my')
            ->table('user')
            ->join('user_document', 'user_document.user_id', '=', 'user.id')
            ->where('user.id', '=', 1)
            ->orderBy('document.id')
            ->select([
                'user.id',
                'user.name',
                'user_document.name AS document_name',
            ])
            ->first()
        ;

print_r(\DB::connection('my')->getQueryLog());
```

## Ресурсы

1. [Database: Query Builder](https://laravel.com/docs/5.3/queries)