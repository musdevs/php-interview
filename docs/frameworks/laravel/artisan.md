# Artisan

## Выполнить артизан-команду через API

[How to Execute Laravel Artisan Commands Using an API Endpoint](https://dev.to/yasserelgammal/how-to-execute-laravel-artisan-commands-using-an-api-endpoint-3d49)

```php
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class CommandController extends Controller
{
    public function runCommand(Request $request)
    {
            $validated = $request->validate(['command' => ['required', 'string']]);

            // Run the Artisan command
            Artisan::call($validated['command']);

            // Get the output of the command
            $output = Artisan::output();

            return response()->json(['message' => 'Command executed successfully', 'output' => $output]);
    }
}
```
