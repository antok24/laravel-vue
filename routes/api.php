<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts', 'PostsController@index');
Route::post('/posts/store','PostsController@store');
Route::get('/posts/{id?}','PostsController@show');
Route::post('/posts/update/{id?}','PostsController@update');
Route::delete('/posts/{id?}','PostsController@destroy');

Route::get('/products', 'ProductController@index');
Route::post('/products/store','ProductController@store');
Route::get('/products/{id?}','ProductController@show');
Route::post('/products/update/{id?}','ProductController@update');
Route::delete('/products/{id?}','ProductController@destroy');

