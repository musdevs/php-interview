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

Условие по дате без учета времени
```php
\DB::connection('my')
    ->table('users')
    ->whereDate('user.updated_at', '=', '2019-08-06')
```

приведет к формированию запроса в PostgreSQL:

```sql
select
	users.id
from
	users
where
	"updated_at"::date = '2019-08-06'
```

а может еще и так

```sql
select
	users.id
from
	users
where
	date_trunc('DAY', updated_at) = '2019-08-06'
```

а в Oracle так

```sql
select
	users.id
from
	users
where
	trunc(updated_at) = '2019-08-06'
```


## Ресурсы

1. [Database: Query Builder](https://laravel.com/docs/5.3/queries)
2. [Eloquent Cheat Sheet](http://laragems.com/post/eloquent-cheat-sheet)
3. [Raw DB Operations with Laravel Cheat Sheet](http://laragems.com/post/raw-db-operations-with-laravel-cheat-sheet)
4. [20 хитростей в Laravel Eloquent о которых вы не знали](https://laravelnews.ru/20-khitrostey-v-laravel-eloquent-o-kotorykh-vy-ne-znali)
5. [10 Hidden Laravel Eloquent Features You May Not Know](https://medium.com/@JinoAntony/10-hidden-laravel-eloquent-features-you-may-not-know-efc8ccc58d9e)
