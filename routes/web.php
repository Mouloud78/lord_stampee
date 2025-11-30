<?php

use App\Routes\Route;
use App\Controllers\UserController;
use App\Controllers\TimbreController;

Route::get('/', 'TimbreController@index');
Route::get('/timbres', 'TimbreController@index');

Route::get('/user/create', 'UserController@create');
Route::post('/user/create', 'UserController@store');

Route::get('/login', 'AuthController@index');
Route::post('/login', 'AuthController@store');

Route::get('/login', 'AuthController@index');
Route::post('/login', 'AuthController@store');
Route::get('/logout', 'AuthController@delete');


Route::dispatch();
