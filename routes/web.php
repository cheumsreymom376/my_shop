<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\OrderController;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [HomeController::class, 'viewProducts'])->name('products.index');
Route::get('/products/{slug}', [HomeController::class, 'productDetails'])->name('products.show');


//froontend product routes
Route::get('/products', [FrontendProductController::class, 'index'])
    ->name('products.index');


Route::get('/category/{slug}', [HomeController::class, 'productsByCategory'])
    ->name('products.category');
/*
|--------------------------------------------------------------------------
| Cart & Order Routes (Authenticated)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::put('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout.index');
    Route::post('/checkout/place', [CartController::class, 'placeOrder'])->name('checkout.place');
    Route::get('/order-confirmation/{id}', [CartController::class, 'orderConfirmation'])->name('order.confirmation');
    Route::get('/my-orders', [CartController::class, 'myOrders'])->name('orders.index');
    Route::get('/orders/{id}', [CartController::class, 'showOrder'])->name('orders.show');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Product Management (Resource routes)
    Route::resource('products', ProductController::class);

    // Category Management (Resource routes)
    Route::resource('categories', CategoryController::class);
});



Route::prefix('admin')
    ->middleware(['auth'])
    ->group(function () {

        Route::resource('users', UserController::class)
            ->names('admin.users');
    });



Route::middleware('auth')->group(function () {

    Route::get(
        '/profile',
        [ProfileController::class, 'index']
    )
        ->name('profile');


    Route::put(
        '/profile',
        [ProfileController::class, 'update']
    )
        ->name('profile.update');
});



Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        Route::get(
            '/dashboard',
            [AdminController::class, 'dashboard']
        )
            ->name('dashboard');


        Route::resource('products', ProductController::class);


        Route::resource('categories', CategoryController::class);


        Route::resource('users', UserController::class);


        Route::get(
            '/orders',
            [OrderController::class, 'index']
        )
            ->name('orders.index');
    });
