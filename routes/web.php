<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FrontendController;




Route::get('/', function () {
    return view('welcome');
});
Route::get('/about', function () {
    return view('about');
});

Route::get('/user/{id}', function ($id) {
    return "User ID: is $id";
});

Route::get('/post/{slug}', function ($slug = 'default-post') {
    return "Post Slug: $slug";
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/test', function () {
    $route = route('dashboard');
    return "The URL for the dashboard route is: $route";
});
Route::prefix('admin')->group(function () {
    Route::get('/users', function () {
        return 'Admin Users';
    });
    Route::get('/posts', function () {
        return 'Admin Posts';
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return 'User Profile';
    });
});
Route::get('/login', function () {
    return 'Login Page';
})->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

Route::get('/category', [CategoryController::class, 'index'])->name("category.list");
Route::get('/category/create', [CategoryController::class, 'create'])->name("category.create");
Route::post('/category', [CategoryController::class, 'store'])->name("category.store");
Route::get("/category/{categoryId}/edit", [CategoryController::class, 'edit'])->name('category.edit');
Route::put("/category/{categoryId}", [CategoryController::class, 'update'])->name('category.update');
Route::delete("/category/{categoryId}", [CategoryController::class, 'destroy'])->name('category.delete');
Route::get('/category/{cateId}', [CategoryController::class, 'show'])->name("category.show");

Route::get('/product',[ProductController::class,'index'])->name('product.index');
Route::get('/product/create',[ProductController::class,'create'])->name('product.create');
Route::post('/product',[ProductController::class,'store'])->name('product.store');
Route::get('/product/{product}',[ProductController::class,'show'])->name('product.show');
Route::delete('/product/{product}',[ProductController::class,'destroy'])->name('product.destroy');
Route::get('/product/{product}/edit',[ProductController::class,'edit'])->name('product.edit');
Route::put('/product/{product}',[ProductController::class,'update'])->name('product.update');

Route::get('/',[FrontendController::class,'index']);
Route::get('/list',[FrontendController::class,'list']);
Route::get('/show/{id}',[FrontendController::class,'show']);