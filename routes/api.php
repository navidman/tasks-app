<?php

use Illuminate\Support\Facades\Route;

Route::post('login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('task', [\App\Http\Controllers\TaskController::class, 'test'])->name('test');
Route::middleware('auth:api')->group(function () {
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'revoke'])->name('revoke');

});
