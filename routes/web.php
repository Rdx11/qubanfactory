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
Route::group(['namespace' => 'Home', 'prefix' => ''], function(){
    Route::get('/', 'HomeController@home')->name('home');
    Route::get('/detail/{name}', 'HomeController@detail')->name('detail');
    Route::get('/product/{id}', 'HomeController@getProduct')->name('get-product');
});

Route::group(['namespace' => 'User', 'prefix' => ''], function(){
    Route::get('/login', 'UserController@login')->name('login');
    Route::post('/register', 'UserController@register')->name('register');
    Route::post('/validate-login', 'UserController@validateLogin')->name('validate-login');
    Route::get('/admin', 'UserController@loginAdmin')->name('login-admin');
    Route::get('/logout', 'UserController@logout')->name('logout');
});

Route::group(['namespace' => 'Cart', 'prefix' => ''], function(){
    Route::get('/cart', 'CartController@index')->name('cart');
    Route::post('/add-to-cart', 'CartController@addProductToCart')->name('add-to-cart');
});

Route::group(['middleware' => ['login-verification', 'revalidate']], function(){
    Route::group(['namespace' => 'Dashboard', 'prefix' => 'dashboard'], function(){
        Route::get('/', 'DashboardController@dashboardAdmin')->name('dashboard');
        Route::get('/user', 'DashboardController@dashboardUser')->name('dashboard-user');
    });

    Route::group(['namespace' => 'Product', 'prefix' => 'product'], function(){
        Route::get('/', 'ProductController@index')->name('product');
        Route::post('/save', 'ProductController@save');
        Route::post('/data-table', 'ProductController@dataTable');
        Route::post('/form', 'ProductController@form');
        Route::post('/delete', 'ProductController@delete');
    });

    Route::group(['namespace' => 'ProductCategories', 'prefix' => 'product-categories'], function(){
        Route::get('/', 'ProductCategoriesController@index')->name('product-categories');
        Route::post('/save', 'ProductCategoriesController@save');
        Route::post('/data-table', 'ProductCategoriesController@dataTable');
        Route::post('/form', 'ProductCategoriesController@form');
        Route::post('/delete', 'ProductCategoriesController@delete');
        Route::get('/get-option', 'ProductCategoriesController@getOption');
    });

    Route::group(['namespace' => 'Pages', 'prefix' => 'pages'], function(){
        Route::get('/', 'PagesController@index')->name('pages');
        Route::post('/save', 'PagesController@save');
        Route::post('/data-table', 'PagesController@dataTable');
        Route::post('/form', 'PagesController@form');
        Route::post('/delete', 'PagesController@delete');
    });

    Route::group(['namespace' => 'Province', 'prefix' => 'province'], function(){
        Route::get('/get-option', 'ProvinceController@getOption');
    });

     Route::group(['namespace' => 'City', 'prefix' => 'city'], function(){
        Route::get('/get-option', 'CityController@getOption');
    });
});

Route::group(['namespace' => 'Transaction', 'prefix' => 'transaction'], function(){
    Route::get('/vtweb', 'TransactionController@vtweb');

    Route::get('/vtdirect', 'TransactionController@vtdirect');
    Route::post('/vtdirect', 'TransactionController@checkout_process');

    Route::get('/vt_transaction', 'TransactionController@transaction');
    Route::post('/vt_transaction', 'TransactionController@transaction_process');

    Route::post('/vt_notif', 'TransactionController@notification');

});

Route::group(['namespace' => 'Vtweb', 'prefix' => 'vtweb'], function(){
    Route::get('/', 'VtwebController@vtweb');
});

Route::group(['namespace' => 'Snap', 'prefix' => 'snap'], function(){
    Route::get('', 'SnapController@snap');
    Route::get('/snaptoken', 'SnapController@token');
    Route::post('/snapfinish', 'SnapController@finish');
});
