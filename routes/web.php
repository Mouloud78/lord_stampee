<?php

use App\Routes\Route;
use App\Controllers\UserController;
use App\Controllers\TimbreController;

Route::get('/', 'TimbreController@index');
Route::get('/timbres', 'TimbreController@index');
Route::dispatch();
