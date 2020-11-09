<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/admin', 'App\Http\Controllers\AdminController@login');
Route::post('/admin', 'App\Http\Controllers\AdminController@postLogin');

Route::get('/administrator', function () {
    return view('administrator');
});

Route::prefix('administrator')->group(function () {
    Route::prefix('menus')->group(function () {
        Route::get('/', [
            'as' => 'menus.index',
            'uses' => 'App\Http\Controllers\MenuController@index'
        ]);
        Route::get('/create', [
            'as' => 'menus.create',
            'uses' => 'App\Http\Controllers\MenuController@create'
        ]);
        Route::post('/createSubmit', [
            'as' => 'menus.createSubmit',
            'uses' => 'App\Http\Controllers\MenuController@createSubmit'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'menus.edit',
            'uses' => 'App\Http\Controllers\MenuController@edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'menus.update',
            'uses' => 'App\Http\Controllers\MenuController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'menus.delete',
            'uses' => 'App\Http\Controllers\MenuController@delete'
        ]);
    });

    Route::prefix('categories')->group(function () {
        Route::get('/', [
            'as' => 'categories.index',
            'uses' => 'App\Http\Controllers\CategoryController@index'
        ]);
        Route::get('/create', [
            'as' => 'categories.create',
            'uses' => 'App\Http\Controllers\CategoryController@create'
        ]);
        Route::post('/createSubmit', [
            'as' => 'categories.createSubmit',
            'uses' => 'App\Http\Controllers\CategoryController@createSubmit'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'categories.edit',
            'uses' => 'App\Http\Controllers\CategoryController@edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'categories.update',
            'uses' => 'App\Http\Controllers\CategoryController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'categories.delete',
            'uses' => 'App\Http\Controllers\CategoryController@delete'
        ]);
    });

    Route::prefix('sliders')->group(function () {
        Route::get('/', [
            'as' => 'sliders.index',
            'uses' => 'App\Http\Controllers\SliderController@index'
        ]);
        Route::get('/create', [
            'as' => 'sliders.create',
            'uses' => 'App\Http\Controllers\SliderController@create'
        ]);
        Route::post('/createSubmit', [
            'as' => 'sliders.createSubmit',
            'uses' => 'App\Http\Controllers\SliderController@createSubmit'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'sliders.edit',
            'uses' => 'App\Http\Controllers\SliderController@edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'sliders.update',
            'uses' => 'App\Http\Controllers\SliderController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'sliders.delete',
            'uses' => 'App\Http\Controllers\SliderController@delete'
        ]);
    });

    Route::prefix('products')->group(function () {
        Route::get('/', [
            'as' => 'products.index',
            'uses' => 'App\Http\Controllers\ProductController@index'
        ]);
        Route::get('/create', [
            'as' => 'products.create',
            'uses' => 'App\Http\Controllers\ProductController@create'
        ]);
        Route::post('/createSubmit', [
            'as' => 'products.createSubmit',
            'uses' => 'App\Http\Controllers\ProductController@createSubmit'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'products.edit',
            'uses' => 'App\Http\Controllers\ProductController@edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'products.update',
            'uses' => 'App\Http\Controllers\ProductController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'products.delete',
            'uses' => 'App\Http\Controllers\ProductController@delete'
        ]);
    });

    Route::prefix('settings')->group(function () {
        Route::get('/', [
            'as' => 'settings.index',
            'uses' => 'App\Http\Controllers\SettingController@index'
        ]);
        Route::get('/create', [
            'as' => 'settings.create',
            'uses' => 'App\Http\Controllers\SettingController@create'
        ]);
        Route::post('/createSubmit', [
            'as' => 'settings.createSubmit',
            'uses' => 'App\Http\Controllers\SettingController@createSubmit'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'settings.edit',
            'uses' => 'App\Http\Controllers\SettingController@edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'settings.update',
            'uses' => 'App\Http\Controllers\SettingController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'settings.delete',
            'uses' => 'App\Http\Controllers\SettingController@delete'
        ]);
    });
});
