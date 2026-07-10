<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/user', function () {
    return ['name' => 'John', 'email' => 'john@example.com'];
});


Route::get('/postsapi', [PostController::class, 'index'])->name('posts.index');
Route::post('/postsapi', [PostController::class, 'store'])->name('posts.store');
Route::get('/postsapi/{post}', [PostController::class, 'show'])->name('posts.show');
Route::put('/postsapi/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/postsapi/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::post('/registerapi', [AuthController::class, 'register']);
Route::post('/loginapi', [AuthController::class, 'login'])->name('login');
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/dashboardapi', [AuthController::class, 'dashboard']);
    Route::post('/logoutapi', [AuthController::class, 'logout'])->name('logout');
});