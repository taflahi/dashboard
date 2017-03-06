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
    return view('home');
});


Route::post('crawler', [
   'uses' => 'CrawlerController@create'
]);

Route::post('register', [
   'uses' => 'RegisterController@create'
]);

Route::post('register/edit', [
   'uses' => 'RegisterController@edit'
]);

Route::post('crawler/canceled', [
   'uses' => 'CrawlerController@back'
]);