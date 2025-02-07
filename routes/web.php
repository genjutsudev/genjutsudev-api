<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::any('/{any}', function () {
    return response([
        'jsonrpc' => '2.0',
        'result' => ['message' => 'Hello, API!'],
        'id' => 1
    ], $code = 200)->header('Content-Type', 'application/json');
})->where('any', '.*');
