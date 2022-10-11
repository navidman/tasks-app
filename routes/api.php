<?php

use Illuminate\Support\Facades\Route;

Route::post('login', [\App\Http\Controllers\Auth\AuthController::class, 'login'])->name('login');

Route::middleware('auth:api')->group(function () {

    Route::post('logout', [\App\Http\Controllers\Auth\AuthController::class, 'revoke'])->name('revoke');
    Route::get('admin/user', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.user.index');
    Route::get('admin/task', [\App\Http\Controllers\Admin\TaskController::class, 'index'])->name('admin.task.index');
    Route::put('admin/task/{task}', [\App\Http\Controllers\Admin\TaskController::class, 'update'])->name('admin.task.update');
    Route::delete('admin/task/{task}', [\App\Http\Controllers\Admin\TaskController::class, 'delete'])->name('admin.task.delete');
    Route::get('admin/task/{task}/join', [\App\Http\Controllers\Admin\TaskController::class, 'join'])->name('admin.task.join');

    Route::get('task', [\App\Http\Controllers\User\TaskController::class, 'index'])->name('user.task.index');
    Route::post('task', [\App\Http\Controllers\User\TaskController::class, 'store'])->name('user.task.store');
    Route::delete('task/{task}', [\App\Http\Controllers\User\TaskController::class, 'delete'])->name('user.task.delete');
});
