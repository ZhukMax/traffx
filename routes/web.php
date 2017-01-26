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

Route::get('/',      'PageController@index');
Route::get('/pages/{id}',  'PageController@show');

Auth::routes();

Route::get('/admin', 'AdminController@index');
Route::get('/admin/pages', 'AdminController@pages');
Route::get('/admin/page/{id}', 'AdminController@page');
