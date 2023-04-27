<?php

use App\Http\Controllers\ExclusiveController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    // User routes, only accessible by admin
    Route::group(['prefix' => 'users', 'as' => 'users.', 'middleware' => ['role:admin']], function () {
        Route::get('/', 'UsersController@index')->name('index');
        Route::get('/create', 'UsersController@create')->name('create');
        Route::post('/store', 'UsersController@store')->name('store');
        Route::get('/delete/{id}', 'UsersController@destroy')->name('destroy');
    });
    // User routes, generic
    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('/changepassword/{id}', 'UsersController@changePassword')->name('changePassword');
        Route::post('/updatepassword/{id}', 'UsersController@updatePassword')->name('updatePassword');
    });

    // Products
    Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
        Route::get('/', 'ProductController@index')->name('index');
        Route::get('/create', 'ProductController@create')->name('create');
        Route::post('/store', 'ProductController@store')->name('store');
        Route::get('/edit/{product}', 'ProductController@edit')->name('edit');
        Route::put('/{product}', 'ProductController@update')->name('update');
        Route::get('/delete/{product}', 'ProductController@destroy')->name('destroy');
    });

    // Categories
    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
        Route::get('/', 'CategoryController@index')->name('index');
        Route::get('/create', 'CategoryController@create')->name('create');
        Route::post('/store', 'CategoryController@store')->name('store');
        Route::get('/edit/{category}', 'CategoryController@edit')->name('edit');
        Route::put('/{category}', 'CategoryController@update')->name('update');
        Route::get('/delete/{category}', 'CategoryController@destroy')->name('destroy');
    });

    // Brands
    Route::group(['prefix' => 'brands', 'as' => 'brands.'], function () {
        Route::get('/', 'BrandController@index')->name('index');
        Route::get('/create', 'BrandController@create')->name('create');
        Route::post('/store', 'BrandController@store')->name('store');
        Route::get('/edit/{brand}', 'BrandController@edit')->name('edit');
        Route::put('/{brand}', 'BrandController@update')->name('update');
        Route::get('/delete/{brand}', 'BrandController@destroy')->name('destroy');
    });

    // Unit
    Route::group(['prefix' => 'units', 'as' => 'units.'], function () {
        Route::get('/', 'UnitController@index')->name('index');
        Route::get('/create', 'UnitController@create')->name('create');
        Route::post('/store', 'UnitController@store')->name('store');
        Route::get('/edit/{unit}', 'UnitController@edit')->name('edit');
        Route::put('/{unit}', 'UnitController@update')->name('update');
        Route::get('/delete/{unit}', 'UnitController@destroy')->name('destroy');
    });

    // Suppliers
    Route::group(['prefix' => 'suppliers', 'as' => 'suppliers.'], function () {
        Route::get('/', 'SupplierController@index')->name('index');
        Route::get('/create', 'SupplierController@create')->name('create');
        Route::post('/store', 'SupplierController@store')->name('store');
        Route::get('/edit/{supplier}', 'SupplierController@edit')->name('edit');
        Route::put('/{supplier}', 'SupplierController@update')->name('update');
        Route::get('/delete/{supplier}', 'SupplierController@destroy')->name('destroy');
    });

    // Stocks
    Route::group(['prefix' => 'stocks', 'as' => 'stocks.'], function () {
        Route::get('/', 'StockController@index')->name('index');
        Route::get('/create', 'StockController@create')->name('create');
        Route::get('/viewPurchase/{stock}', 'StockController@viewPurchase')->name('viewPurchase');
        Route::post('/store', 'StockController@store')->name('store');
        Route::get('/edit/{stock}', 'StockController@edit')->name('edit');
        Route::put('/{stock}', 'StockController@update')->name('update');
        Route::get('/delete/{stock}', 'StockController@destroy')->name('destroy');
    });

    // Purchases
    Route::group(['prefix' => 'purchases', 'as' => 'purchases.'], function () {
        Route::get('/', 'PurchaseController@index')->name('index');
        Route::get('/create', 'PurchaseController@create')->name('create');
        Route::post('/store', 'PurchaseController@store')->name('store');
        Route::get('/show/{purchase}', 'PurchaseController@show')->name('show');
        Route::get('/delete/{purchase}', 'PurchaseController@destroy')->name('destroy');
        Route::get('/pending', 'PurchaseController@pending')->name('pending');
        Route::get('/approve/{purchase}', 'PurchaseController@approve')->name('approve');
    });

    // Exclusive Routes only For Making Purchase
    Route::group([], function () {
        Route::get('/get-product', [ExclusiveController::class, 'GetProduct'])->name('get-product');
        Route::get('/get-supplier/{id}/name', [SupplierController::class, 'getName'])->name('get-supplier');
    });
});
