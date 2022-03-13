<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('',[HomeController::class, 'index'] )->middleware('can:admin.home')->name('admin.home');

Route::resource('categories', CategoryController::class)->names('admin.categories');