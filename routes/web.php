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

//client
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/category/{slug}/{id}', [
    'as' => 'category.product',
    'uses' => 'App\Http\Controllers\CategoryController@showProductByCategory'
]);
Route::prefix('products')->group(function () {
    Route::get('/', [
        'as' => 'products.all',
        'uses' => 'App\Http\Controllers\ProductController@showAllProduct',
    ]);
    Route::get('/detail/{id}', [
        'as' => 'products.detail',
        'uses' => 'App\Http\Controllers\ProductController@detail',
    ]);
    Route::get('/add-to-cart/{id}', [
        'as' => 'products.add_to_cart',
        'uses' => 'App\Http\Controllers\ProductController@addToCart',
    ]);
    Route::get('/cart', [
        'as' => 'cart',
        'uses' => 'App\Http\Controllers\ProductController@showCart',
    ]);
    Route::get('/cart_update', [
        'as' => 'cart.update',
        'uses' => 'App\Http\Controllers\ProductController@updateCart',
    ]);
    Route::get('/cart_delete', [
        'as' => 'cart.delete',
        'uses' => 'App\Http\Controllers\ProductController@deleteCart',
    ]);
});
Route::prefix('checkout')->group(function () {
    Route::get('/', [
        'as' => 'checkout.index',
        'uses' => 'App\Http\Controllers\CheckoutController@index',
    ]);
    Route::get('/login', [
        'as' => 'checkout.login',
        'uses' => 'App\Http\Controllers\CheckoutController@loginCheckout',
    ]);
    Route::get('/logout', [
        'as' => 'checkout.logout',
        'uses' => 'App\Http\Controllers\CheckoutController@logoutCheckout',
    ]);
    Route::post('/register', [
        'as' => 'checkout.register',
        'uses' => 'App\Http\Controllers\CheckoutController@registerCheckout',
    ]);
    Route::post('/save', [
        'as' => 'checkout.saveCheckoutCustomer',
        'uses' => 'App\Http\Controllers\CheckoutController@saveCheckoutCustomer',
    ]);
    Route::get('/payment', [
        'as' => 'checkout.payment',
        'uses' => 'App\Http\Controllers\CheckoutController@payment',
    ]);
    Route::post('/order', [
        'as' => 'checkout.order',
        'uses' => 'App\Http\Controllers\CheckoutController@sendOrder',
    ]);
});
Route::post('/login', [
    'as' => 'login.customer',
    'uses' => 'App\Http\Controllers\CheckoutController@loginCustomer'
]);



//admin
Route::get('/login', 'App\Http\Controllers\AdminController@login')->name('login');
Route::post('/administrator', 'App\Http\Controllers\AdminController@postLogin')->name('postLogin');
Route::get('/logout', 'App\Http\Controllers\AdminController@logout')->name('logout');

Route::get('/administrator', function () {
    return view('administrator');
})->name('admin')->middleware('auth');

Route::prefix('administrator')->group(function () {
    Route::prefix('menus')->group(function () {
        Route::get('/', [
            'as' => 'menus.index',
            'uses' => 'App\Http\Controllers\MenuController@index',
            'middleware' => 'can:menu-list'
        ]);
        Route::get('/create', [
            'as' => 'menus.create',
            'uses' => 'App\Http\Controllers\MenuController@create',
            'middleware' => 'can:menu-create'
        ]);
        Route::post('/createSubmit', [
            'as' => 'menus.createSubmit',
            'uses' => 'App\Http\Controllers\MenuController@createSubmit'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'menus.edit',
            'uses' => 'App\Http\Controllers\MenuController@edit',
            'middleware' => 'can:menu-edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'menus.update',
            'uses' => 'App\Http\Controllers\MenuController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'menus.delete',
            'uses' => 'App\Http\Controllers\MenuController@delete',
            'middleware' => 'can:menu-delete'
        ]);
    });

    Route::prefix('categories')->group(function () {
        Route::get('/', [
            'as' => 'categories.index',
            'uses' => 'App\Http\Controllers\CategoryController@index',
            'middleware' => 'can:category-list'
        ]);
        Route::get('/create', [
            'as' => 'categories.create',
            'uses' => 'App\Http\Controllers\CategoryController@create',
            'middleware' => 'can:category-create'
        ]);
        Route::post('/createSubmit', [
            'as' => 'categories.createSubmit',
            'uses' => 'App\Http\Controllers\CategoryController@createSubmit',
        ]);
        Route::get('/edit/{id}', [
            'as' => 'categories.edit',
            'uses' => 'App\Http\Controllers\CategoryController@edit',
            'middleware' => 'can:category-edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'categories.update',
            'uses' => 'App\Http\Controllers\CategoryController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'categories.delete',
            'uses' => 'App\Http\Controllers\CategoryController@delete',
            'middleware' => 'can:category-delete'
        ]);
    });

    Route::prefix('sliders')->group(function () {
        Route::get('/', [
            'as' => 'sliders.index',
            'uses' => 'App\Http\Controllers\SliderController@index',
            'middleware' => 'can:slider-list'
        ]);
        Route::get('/create', [
            'as' => 'sliders.create',
            'uses' => 'App\Http\Controllers\SliderController@create',
            'middleware' => 'can:slider-create'
        ]);
        Route::post('/createSubmit', [
            'as' => 'sliders.createSubmit',
            'uses' => 'App\Http\Controllers\SliderController@createSubmit'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'sliders.edit',
            'uses' => 'App\Http\Controllers\SliderController@edit',
            'middleware' => 'can:slider-edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'sliders.update',
            'uses' => 'App\Http\Controllers\SliderController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'sliders.delete',
            'uses' => 'App\Http\Controllers\SliderController@delete',
            'middleware' => 'can:slider-delete'
        ]);
    });

    Route::prefix('products')->group(function () {
        Route::get('/', [
            'as' => 'products.index',
            'uses' => 'App\Http\Controllers\ProductController@index',
            'middleware' => 'can:product-list'
        ]);
        Route::get('/create', [
            'as' => 'products.create',
            'uses' => 'App\Http\Controllers\ProductController@create',
            'middleware' => 'can:product-create'
        ]);
        Route::post('/createSubmit', [
            'as' => 'products.createSubmit',
            'uses' => 'App\Http\Controllers\ProductController@createSubmit'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'products.edit',
            'uses' => 'App\Http\Controllers\ProductController@edit',
            'middleware' => 'can:product-edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'products.update',
            'uses' => 'App\Http\Controllers\ProductController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'products.delete',
            'uses' => 'App\Http\Controllers\ProductController@delete',
            'middleware' => 'can:product-delete'
        ]);
    });

    Route::prefix('settings')->group(function () {
        Route::get('/', [
            'as' => 'settings.index',
            'uses' => 'App\Http\Controllers\SettingController@index',
            'middleware' => 'can:setting-list'
        ]);
        Route::get('/create', [
            'as' => 'settings.create',
            'uses' => 'App\Http\Controllers\SettingController@create',
            'middleware' => 'can:setting-create'
        ]);
        Route::post('/createSubmit', [
            'as' => 'settings.createSubmit',
            'uses' => 'App\Http\Controllers\SettingController@createSubmit'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'settings.edit',
            'uses' => 'App\Http\Controllers\SettingController@edit',
            'middleware' => 'can:setting-edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'settings.update',
            'uses' => 'App\Http\Controllers\SettingController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'settings.delete',
            'uses' => 'App\Http\Controllers\SettingController@delete',
            'middleware' => 'can:setting-delete'
        ]);
    });

    Route::prefix('users')->group(function () {
        Route::get('/', [
            'as' => 'users.index',
            'uses' => 'App\Http\Controllers\UserController@index',
            'middleware' => 'can:user-list'
        ]);
        Route::get('/create', [
            'as' => 'users.create',
            'uses' => 'App\Http\Controllers\UserController@create',
            'middleware' => 'can:user-create'
        ]);
        Route::post('/createSubmit', [
            'as' => 'users.createSubmit',
            'uses' => 'App\Http\Controllers\UserController@createSubmit'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'users.edit',
            'uses' => 'App\Http\Controllers\UserController@edit',
            'middleware' => 'can:user-edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'users.update',
            'uses' => 'App\Http\Controllers\UserController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'users.delete',
            'uses' => 'App\Http\Controllers\UserController@delete',
            'middleware' => 'can:user-delete'
        ]);
    });

    Route::prefix('roles')->group(function () {
        Route::get('/', [
            'as' => 'roles.index',
            'uses' => 'App\Http\Controllers\RoleController@index',
            'middleware' => 'can:role-list'
        ]);
        Route::get('/create', [
            'as' => 'roles.create',
            'uses' => 'App\Http\Controllers\RoleController@create',
            'middleware' => 'can:role-create'
        ]);
        Route::post('/createSubmit', [
            'as' => 'roles.createSubmit',
            'uses' => 'App\Http\Controllers\RoleController@createSubmit'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'roles.edit',
            'uses' => 'App\Http\Controllers\RoleController@edit',
            'middleware' => 'can:role-edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'roles.update',
            'uses' => 'App\Http\Controllers\RoleController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'roles.delete',
            'uses' => 'App\Http\Controllers\RoleController@delete',
            'middleware' => 'can:role-delete'
        ]);
    });

    Route::prefix('permissions')->group(function () {
        Route::get('/', [
            'as' => 'permissions.index',
            'uses' => 'App\Http\Controllers\PermissionController@index',
            'middleware' => 'can:permission-list'
        ]);
        Route::get('/create', [
            'as' => 'permissions.create',
            'uses' => 'App\Http\Controllers\PermissionController@create',
            'middleware' => 'can:permission-create'
        ]);
        Route::post('/createSubmit', [
            'as' => 'permissions.createSubmit',
            'uses' => 'App\Http\Controllers\PermissionController@createSubmit'
        ]);
    });

    Route::prefix('orders')->group(function () {
        Route::get('/', [
            'as' => 'orders.manager',
            'uses' => 'App\Http\Controllers\OrderController@index',
            'middleware' => 'can:order-list'
        ]);
        Route::get('/detail/{id}', [
            'as' => 'order.detail',
            'uses' => 'App\Http\Controllers\OrderController@detail',
            'middleware' => 'can:order-detail'
        ]);
    });
});
