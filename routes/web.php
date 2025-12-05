<?php

use App\Routes\Route;
use App\Controllers\UserController;
use App\Controllers\TimbreController;

Route::get('/', 'EnchereController@index');
Route::get('/encheres', 'EnchereController@index');

Route::get('/user/create', 'UserController@create');
Route::post('/user/create', 'UserController@store');

Route::get('/timbre/create', 'TimbreController@create');
Route::post('/timbre/create', 'TimbreController@store');

Route::get('/login', 'AuthController@index');
Route::post('/login', 'AuthController@store');

Route::get('/login', 'AuthController@index');
Route::post('/login', 'AuthController@store');
Route::get('/logout', 'AuthController@delete');


Route::dispatch();
