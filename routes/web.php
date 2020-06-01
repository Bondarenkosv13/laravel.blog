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

Route::get('/home', 'HomeController@index')->name('home');

Route::name('admin.')->group(function () {
    Route::get('orders', 'OrdersController@index')->name('orders'); //show all orders
    Route::get('{id}/orders', 'OrdersController@show')->name('orders.show'); // show the order
    Route::get('orders/create', 'OrdersController@create')->name('orders.create'); // view create a order
    Route::post('orders/store', 'OrdersController@store')->name('orders.store'); // store to create the order
    Route::get('orders/{id}/edit', 'OrdersController@edit')->name('orders.edit'); // view edit the order
    Route::post('orders/{id}/update', 'OrdersController@update')->name('orders.update'); // update the order
    Route::delete('orders/{id}/delete', 'OrdersController@delelet')->name('orders.delete'); // delete the order

    Route::get('categories', 'CategoriesController@index')->name('categories'); //show all categories
    Route::get('{id}/categories', 'CategoriesController@show')->name('categories.show'); // show the category
    Route::get('categories/create', 'CategoriesController@create')->name('categories.create'); // view create a category
    Route::post('categories/store', 'CategoriesController@store')->name('categories.store'); // store to create the category
    Route::get('categories/{id}/edit', 'CategoriesController@edit')->name('categories.edit'); // view edit the category
    Route::post('categories/{id}/update', 'CategoriesController@update')->name('categories.update'); // update the category
    Route::delete('categories/{id}/delete', 'CategoriesController@delelet')->name('categories.delete'); // delete the category

    Route::get('products', 'ProductController@index')->name('products'); //show all products
    Route::get('{id}/products', 'ProductController@show')->name('products.show'); // show the product
    Route::get('products/create', 'ProductController@create')->name('products.create'); // view create a product
    Route::post('products/store', 'ProductController@store')->name('products.store'); // store to create the product
    Route::get('products/{id}/edit', 'ProductController@edit')->name('products.edit'); // view edit the product
    Route::post('products/{id}/update', 'ProductController@update')->name('products.update'); // update the product
    Route::delete('products/{id}/delete', 'ProductController@delelet')->name('products.delete'); // delete the product

    Route::get('users', 'UsersController@index')->name('users'); //show all users
    Route::get('{id}/users', 'UsersController@show')->name('users.show'); // show the user
    Route::delete('users/{id}/delete', 'UsersController@delelet')->name('users.delete'); // delete the user
});
