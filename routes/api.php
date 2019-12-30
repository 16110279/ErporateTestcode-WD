<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'v0'
], function () {

    Route::post('/login', 'API\UserController@login');

    Route::get('/user', 'API\UserController@detail');
    Route::post('/logout', 'API\UserController@logout');


    Route::group([
        'middleware' => 'auth:api'
    ], function () {

        // Product

        Route::get('/product', 'API\ProductController@index');
        Route::get('/product/active', 'API\ProductController@active');
        Route::post('/product', 'API\ProductController@store');
        Route::get('/product/{id}', 'API\ProductController@show');
        Route::delete('/product/{id}', 'API\ProductController@destroy');
        Route::put('/product/{id}', 'API\ProductController@update');
        Route::get('/countcart', 'API\ProductController@ccart');

        // Picture

        Route::post('product/{id}/picture', 'API\PictureController@storeImage');
        // Route::post('product/{id}/picture', 'API\PictureController@store');
        Route::get('picture', 'API\PictureController@index');
        Route::get('picture/{id}', 'API\PictureController@byproduct');
        Route::delete('picture/{id}', 'API\PictureController@destroy');
        Route::post('picture', 'API\PictureController@store');


        // Category
        Route::get('/category', 'API\CategoryController@index');
        Route::post('/category', 'API\CategoryController@store');
        Route::put('/category', 'API\CategoryController@update');
        Route::get('/category/{id}', 'API\CategoryController@show');
        Route::delete('/category/{id}', 'API\CategoryController@destroy');

        // Transaction
        Route::post('/transaction', 'API\TransactionController@store');
        Route::get('/transaction/{id}', 'API\TransactionController@show');
        Route::delete('/transaction/{id}', 'API\TransactionController@destroy');
        Route::put('/transaction/{id}', 'API\TransactionController@update');
    });
});
