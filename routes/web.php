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
    return view('welcome');
});

Route::resource('/costs', 'CostsController');
Route::resource('/incomes', 'IncomesController');
Route::post('/incomes.filter', 'IncomesController@filter')->name('filterIncomes');
Route::post('/costs.filter', 'CostsController@filter')->name('filterCosts');

