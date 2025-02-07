<?php

declare(strict_types=1);

use App\Http\Procedures\UserProcedure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::group([
    'prefix' => 'rpc',
    'as' => 'rpc',
    'middleware' => ['auth:api'],
], function () {
    Route::rpc('v1', [
        UserProcedure::class,
    ])->name('.v1');
});
