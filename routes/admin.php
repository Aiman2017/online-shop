<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/no-access/{model}', [AdminController::class, 'noAccess'])->name('no-access');

Route::group(['middleware' => ['auth', 'roles:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::post('clear-cache', [AdminController::class, 'clearCache'])->name('clear-cache');
    Route::delete('{images}/{id}/images', [ImageController::class, 'destroyAll'])->name('images.delete.all');

    Route::delete('images/{id}', [ImageController::class, 'destroy'])->name('images.delete');
    Route::post('{images}/{id}/download-all', [ImageController::class, 'downloadAll'])->name('images.download.all');
    //ajax
    Route::put('sortable', [ImageController::class, 'imageSortable'])->name('image.sortable');


    Route::prefix('dashboard')->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class)->middleware(['model:Category,Brand']);
        //ajax
        Route::post('sub-category', [CategoryController::class, 'subCategory'])->name('get.sub.category');


        Route::resource('brands', BrandController::class);
        Route::resource('banners', BannerController::class);
        Route::resource('orders', OrderController::class);
    });
});
