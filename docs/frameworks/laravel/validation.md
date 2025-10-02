# Валидация в Laravel

## Примеры

### Базовая валидация

```php
use Illuminate\Http\Request;

public function store(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
    ]);

    // Proceed with the validated data...
}
```

### Custom Error Messages

```php
$request->validate([
    'email' => 'required|email',
    'password' => 'required|min:6',
], [
    'email.required' => 'Email is required for registration.',
    'password.min' => 'Passwords must be at least 6 characters.',
]);
```

### Validating Arrays

```php
$request->validate([
    'tags' => 'required|array',
    'tags.*' => 'required|string|distinct|min:3',
]);
```

### File Uploads and Size Constraints

```php
$request->validate([
    'document' => 'required|file|mimes:pdf,docx|max:5000',
]);
```

## Отладка

Если требуется посмотреть какие валидаторы отрабатывают, то точку отладки ставим
в методе vendor/laravel/framework/src/Illuminate/Validation/Validator.php:685:

```php
if ($validatable && ! $this->$method($attribute, $value, $parameters, $this)) { // в этой строке
      $this->addFailure($attribute, $rule, $parameters);
}
```

## Ссылки

- [The Art of Validation in Laravel: A Comprehensive Guide](https://dev.to/mktheitguy/the-art-of-validation-in-laravel-a-comprehensive-guide-4cjo)
