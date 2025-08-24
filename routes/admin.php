<?php

use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth:sanctum', 'role:Admin'])->group(function () {
    Route::apiResource('/posts', PostController::class);
    Route::apiResource('/categories', CategoryController::class);
    Route::apiResource('/tags', TagController::class);
    Route::apiResource('/users', UserController::class);
    Route::apiResource('/roles', RoleController::class);

    Route::get('/tags/{tag}/posts', [TagController::class, 'posts']);
    Route::get('/categories/{category}/posts', [CategoryController::class, 'posts']);
});