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

// Route::get('/', function () {
//     return view('home');
// });
Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/companies/new', 'companyController@index')->name('home');
Route::get('/companies/new/get/company', 'companyController@getCompanyToNew');
Route::post('/companies/store', 'companyController@store');
