# Тестирование

## Mockery (имитации)

### Имитации фасадов

Имитация того, что вызов Cache::get('myKey', 'myDefaultValue') вернул 'myValue'

```php
\Illuminate\Support\Facades\Cache::shouldReceive('get')
    ->with('myKey', 'myDefaultValue')
    ->andReturn('myValue');
```

## Ссылки

- [Practical PHPUnit: Testing XML generation](https://qafoo.com/blog/007_practical_phpunit_testing_xml_generation.html)
