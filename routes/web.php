<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::prefix('ajax')->name('ajax.')->namespace('Ajax')->group(function() {
    Route::delete('images/{image}/remove', 'ImagesController@remove')->name('image.remove');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->namespace('Admin')->name('admin.')->group(function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::resource('/categories', 'CategoriesController')->except('show');
    Route::resource('/products', 'ProductsController')->except('show');
});
