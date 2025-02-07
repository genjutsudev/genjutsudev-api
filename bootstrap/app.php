<?php

declare(strict_types=1);

use App\Http\Middleware\{CheckApiKeyIsActive, MeasureExecutionTime, ForceJsonResponse};
use Illuminate\Foundation\{Application, Configuration\Exceptions, Configuration\Middleware};

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php', apiPrefix: '',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(['*']);
        $middleware->prependToGroup('api', [
            CheckApiKeyIsActive::class,
            MeasureExecutionTime::class,
            ForceJsonResponse::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
