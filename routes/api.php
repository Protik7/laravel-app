<?php

use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\AuthorController;
use App\Http\Controllers\User\CategoryController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{post}', [PostController::class, 'show']);
Route::get('/popular_posts', [PostController::class, 'popular_posts']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category}', [CategoryController::class, 'show']);
Route::get('/categories/{category}/posts', [CategoryController::class, 'posts']);

Route::get('/tags', [TagController::class, 'index']);
Route::get('/tags/{tag}', [TagController::class, 'show']);
Route::get('/tags/{tag}/posts', [TagController::class, 'posts']);

Route::get('/authors', [AuthorController::class, 'index']);
Route::get('/authors/{user}', [AuthorController::class, 'show']);
Route::get('/authors/{user}/posts', [AuthorController::class, 'posts']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'reset']);

require __DIR__ . "/admin.php";
