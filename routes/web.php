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

Route::get('/', 'EmployeeController@index') -> name('employee-index');

Route::get('/show/{id}', 'EmployeeController@show') -> name('employee-show');

Route::get('/create', 'EmployeeController@create') -> name('employee-create');

Route::post('/create', 'EmployeeController@store') -> name('employee-store');

Route::get('/destroy/{id}', 'EmployeeController@destroy') -> name('employee-destroy');

Route::get('/edit/{id}', 'EmployeeController@edit') -> name('employee-edit');

Route::post('/update/{id}', 'EmployeeController@update') -> name('employee-update');