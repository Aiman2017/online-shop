<?php

use App\Http\Controllers\FrontEnd\CartController;
use App\Http\Controllers\FrontEnd\CategoryController as Category;
use App\Http\Controllers\FrontEnd\HomeController;
use App\Http\Controllers\FrontEnd\ProductController as Product;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'roles:user'])->get('/', function () {
    return "I sware, I will do it";
})->name('user.dashboard');

Route::group(['prefix' => '/', 'as' => 'shop.'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/products', [Product::class, 'index'])->name('products');
    Route::get('/categories/', [Category::class, 'index'])->name('category');
    Route::get('category/{category:slug}', [Category::class, 'show'])->name('category.show');

    Route::delete('cart', [CartController::class, 'clear'])->name('cart.clear');
    Route::resource('cart', CartController::class);
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
