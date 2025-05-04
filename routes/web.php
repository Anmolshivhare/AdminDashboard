<?php

use App\DataTables\ProductsDataTable;
use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductPriceController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/logout', function () {
//     return view('auth.login');
// });
Route::middleware(['auth'])->group(function () {
    Route::resource('product-prices', ProductPriceController::class);
    Route::resource('products', ProductController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('roles', RoleController::class);
    Route::post('/search/data', [ProductController::class, 'searchData'])->name('search.data');
    Route::get('/products/data', [ProductController::class, 'data'])->name('products.data');
    Route::resource('shops', ShopController::class);
    Route::resource('users', UserController::class);
    Route::get('profile-update', [UserController::class, 'userProfile'])->name('profile.update');
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
});
Auth::routes();
// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
