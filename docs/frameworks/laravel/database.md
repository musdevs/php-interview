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

Вывести запрос в [Tinker](http://laragems.com/post/a-quick-way-to-display-a-sql-query-in-tinker)

```php
\DB::listen(function ($query) { dump($query->sql); dump($query->bindings); dump($query->time); });
```
 
## Ресурсы

1. [Database: Query Builder](https://laravel.com/docs/5.3/queries)
2. [Eloquent Cheat Sheet](http://laragems.com/post/eloquent-cheat-sheet)
3. [Raw DB Operations with Laravel Cheat Sheet](http://laragems.com/post/raw-db-operations-with-laravel-cheat-sheet)