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
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();
Route::get('/changePassword','HomeController@showChangePasswordForm');
Route::post('/changePassword','HomeController@changePassword')->name('changePassword');

Route::get('/companies/new', 'companyController@index')->name('home');
Route::post('/companies/new/get/company', 'companyController@getCompanyToNew');
Route::post('/companies/store', 'companyController@store');
Route::post('/companies/update', 'companyController@update');
Route::post('/companies/delete', 'companyController@delete');

Route::get('/guitsetgel/new', 'GuitsetgelController@index')->name('home');
Route::post('/guitsetgel/new/get', 'GuitsetgelController@getCompanyToNew');
Route::post('/guitsetgel/store', 'GuitsetgelController@store');
Route::post('/guitsetgel/update', 'GuitsetgelController@update');
Route::post('/guitsetgel/delete', 'GuitsetgelController@delete');

Route::get('/show/companies/slider', 'companyController@showSlider');
