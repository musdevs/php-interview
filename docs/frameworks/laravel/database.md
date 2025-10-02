# Database

## Query Builder

### Вывести исполняемый запрос
([см.](https://stackoverflow.com/questions/27753868/how-to-get-the-query-executed-in-laravel-5-dbgetquerylog-returning-empty-ar))
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

### Получить текст SQL-запроса из объекта Builder

```php
echo vsprintf(str_replace(['?'], ['\'%s\''], $query->toSql()), $query->getBindings());
```

### Вывести запрос в [Tinker](http://laragems.com/post/a-quick-way-to-display-a-sql-query-in-tinker)

```php
\DB::listen(function ($query) {
    dump($query->sql);
    dump($query->bindings);
    dump($query->time);
});
```

### Логирование всех запросов

```php
// \app\Providers\AppServiceProvider.php

use DB;
use Log;

public function boot()
{
    DB::listen(function ($query) {
        Log::info(
            $query->sql,
            $query->bindings,
            $query->time
        );
    });
}

```

### Условие по дате без учета времени
```php
\DB::connection('my')
    ->table('users')
    ->whereDate('user.updated_at', '=', '2019-08-06')
```

приведет к формированию запроса

```mysql
select
	users.id
from
	users
where
	DATE(updated_at) = '2019-08-06'
```

в PostgreSQL:

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

## Оптимизация

### Используйте pluck

При использовании pluck не создаются объекты модели, поэтому работает быстрее

#### Если нужно одно поле

```php
$posts = Post::pluck('title', 'slug');
// [ 0 => title, 1 => title ]
```

#### Если нужно два поля

```php
$posts = Post::pluck('title', 'slug');
// [ slug => title, slug => title ]
```

### Количество записей

```php
$posts = Post::count();
// select * from posts
```

```php
$posts = Post::all()->count();
// select count(*) from posts
```

### Избегать N+1 запросов, использовать жадную загрузку

```php
// избегайте делать так
$posts = Post::all();
// лучше делайте так
$posts = Post::with(['author'])->get();
```

```sql
select * from posts
select * from authors where id in( { post1.author_id }, { post2.author_id }, { post3.author_id }, { post4.author_id }, { post5.author_id } )
```

Для вложенных отношений

```php
$posts = Post::with(['author.team'])->get();
```

Выполнится 3 запроса

```sql
select * from posts // предположим, что запрос вернул 5 сообщений
select * from authors where id in( { post1.author_id }, { post2.author_id }, { post3.author_id }, { post4.author_id }, { post5.author_id } )
select * from teams where id in( { author1.team_id }, { author2.team_id }, { author3.team_id }, { author4.team_id }, { author5.team_id } )
```

## Макросы

### Макрос whereLike

```php
class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        /**
        * Filter the query using a LIKE expression.
        * $query->whereLike('name', 'Ivan');
        */
        Builder::macro('whereLike', function($key, $value) {
            return Builder::where($key, 'LIKE', "{$value}%");
        });
    }
}
```

### Макрос second

```php
class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        /**
        * Retrieve the second item in the results.
        * $query->second();
        */
        Builder::macro('second', function($key, $value) {
            return $this->offset(1)->limit(1)->first();
        });
    }
}
```

### Макрос toRawSql

```php
class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        /**
        * Merge query bindings into raw SQL string, then dump it and die.
        * $query->toRawSql();
        */
        Builder::macro('toRawSql', function($key, $value) {
            dd(vsprintf(
                str_replace(
                    ['?'], ['\'%s\''], $this->toSql()
                ),
                $this->getBindings()
            ));
        });
    }
}
```


## Ресурсы

1. [Database: Query Builder](https://laravel.com/docs/5.3/queries)
2. [Eloquent Cheat Sheet](http://laragems.com/post/eloquent-cheat-sheet)
3. [Raw DB Operations with Laravel Cheat Sheet](http://laragems.com/post/raw-db-operations-with-laravel-cheat-sheet)
4. [20 хитростей в Laravel Eloquent о которых вы не знали](https://laravel.demiart.ru/20-hitrostej-pri-rabote-s-laravel-eloquent/)
5. [10 Hidden Laravel Eloquent Features You May Not Know](https://medium.com/@JinoAntony/10-hidden-laravel-eloquent-features-you-may-not-know-efc8ccc58d9e)
6. [How to use Eloquent ORM migrations outside Laravel](https://siipo.la/blog/how-to-use-eloquent-orm-migrations-outside-laravel)
7. [Use Eloquent without Laravel](https://medium.com/@kshitij206/use-eloquent-without-laravel-7e1c73d79977)
8. [18 советов по оптимизации запросов к базе данных](https://laravel.demiart.ru/laravel-database-queries-optimization/)
