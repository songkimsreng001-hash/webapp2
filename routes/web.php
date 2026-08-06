<?php

use App\Http\Controllers\ContactUsFormController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\UpdateProfileController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;


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

//Route::resource('/product',ProductController::class);

Route::get('/product',[ProductController::class,'index'])->name('product.index');
Route::get('/product/create',[ProductController::class,'create'])->name('product.create');
Route::post('/product',[ProductController::class,'store'])->name('product.store');
Route::get('/product/{product}',[ProductController::class,'show'])->name('product.show');
Route::delete('/product/{product}',[ProductController::class,'destroy'])->name('product.destroy');
Route::get('/product/{product}/edit',[ProductController::class,'edit'])->name('product.edit');
Route::put('/product/{product}',[ProductController::class,'update'])->name('product.update');


//Route::resource('/book',BookController::class);

Route::get('/book',[BookController::class,'index'])->name('book.index');
Route::get('/book/create',[BookController::class,'create'])->name('book.create');
Route::post('/book',[BookController::class,'store'])->name('book.store');
Route::get('/book/{book}',[BookController::class,'show'])->name('book.show');
Route::delete('/book/{book}',[BookController::class,'destroy'])->name('book.destroy');
Route::get('/book/{book}/edit',[BookController::class,'edit'])->name('book.edit');
Route::put('/book/{book}',[BookController::class,'update'])->name('book.update');


// Using a Controller (Recommended)
Route::get('/categories/{categoryId}/projects/{projectId}', [ProjectController::class, 'show'])->name('projects.show');

// Using a Closure Callback
Route::get('/users/{id}/{name}', function (string $id, string $name) {
    return 'User ID: ' . $id . ', Name: ' . $name;});

Route::get('/',[FrontendController::class,'index']);
Route::get('/list',[FrontendController::class,'list']);
Route::get('/show/{id}',[FrontendController::class,'show']);

Route::get('/search', [FrontendController::class,'getBySearch']);
Route::get('/frontend/{category?}', [FrontendController::class,'getByCategory']);

// login and register
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('/registration', [AuthController::class, 'registration'])->name('register');
Route::post('/post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('/dashboard', [AuthController::class, 'dashboard']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// change password
Route::get('/change-password', [ChangePasswordController::class, 'index'])->name('form.password');
Route::post('/change-password', [ChangePasswordController::class, 'store'])->name('change.password');

// update profile
Route::get('/update-profile/{user}',  [UpdateProfileController::class, 'editProfile'])->name('profile.edit');
Route::patch('/update-profile/{user}',  [UpdateProfileController::class, 'updateProfile'])->name('profile.update');

// forget password
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


// contact us form
Route::get('/contact', [ContactUsFormController::class, 'createForm']);
Route::post('/contact', [ContactUsFormController::class, 'ContactUsForm'])->name('contact.store');


// cart
Route::get('/cart', [StoreController::class, 'cart'])->name('cart');
Route::get('/add-to-cart/{id}', [StoreController::class, 'addToCart'])->name('add.to.cart');
Route::patch('/update-cart', [StoreController::class, 'update'])->name('update.cart');
Route::delete('/remove-from-cart', [StoreController::class, 'remove'])->name('remove.from.cart');

// checkout
Route::get('/checkout', [StoreController::class, 'checkout'])->name('cart.checkout');

// order
Route::get('/orders', [OrderController::class, 'index'])->name('admin.order');
Route::post('/orders/approve/{id}', [OrderController::class, 'approve'])->name('admin.approve');
Route::post('/orders/reject/{id}', [OrderController::class, 'reject'])->name('admin.reject');


Route::post('/create-payment-intent', [PaymentController::class, 'createPaymentIntent']);