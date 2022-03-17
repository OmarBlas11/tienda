<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\TableController;
use Illuminate\Support\Facades\Route;

Route::get('',[HomeController::class, 'index'] )->middleware('can:admin.home')->name('admin.home');

Route::resource('categories', CategoryController::class)->names('admin.categories');
Route::resource('tables', TableController::class)->names('admin.tables');
Route::resource('products', ProductController::class)->names('admin.products');
Route::resource('sales', SaleController::class)->names('admin.sales');