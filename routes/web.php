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
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::get('/login/dadaa', function(){
  return view('layouts.layout_login');
});

Auth::routes();
Route::get('/changePassword','HomeController@showChangePasswordForm');
Route::post('/changePassword','HomeController@changePassword')->name('changePassword');

Route::get('/companies/new', 'companyController@index')->name('home');
Route::post('/companies/new/get/company', 'companyController@getCompanyToNew');
Route::post('/get/company/by/id', 'companyController@getCompanyByID');
Route::post('/companies/store', 'companyController@store');
Route::post('/companies/update', 'companyController@update');
Route::post('/companies/delete', 'companyController@delete');

Route::get('/guitsetgel/new', 'GuitsetgelController@index')->name('home');
Route::post('/guitsetgel/new/get', 'GuitsetgelController@getCompanyToNew');
Route::post('/guitsetgel/store', 'GuitsetgelController@store');
Route::post('/guitsetgel/update', 'GuitsetgelController@update');
Route::post('/guitsetgel/delete', 'GuitsetgelController@delete');

Route::get('/show/companies/slider', 'companyController@showSlider');


Route::get('/hunHuch/new', 'hunHuchController@index');
Route::post('/hunHuch/new/get', 'hunHuchController@getHunHuchToNew');
Route::post('/hunHuch/store', 'hunHuchController@store');
Route::post('/hunHuch/update', 'hunHuchController@update');
Route::post('/hunHuch/delete', 'hunHuchController@delete');

Route::get('/chart/byDate/{id}', 'GuitsetgelController@chartByDateShow');
// Route::get('/chart/all', 'GuitsetgelController@chartAllShow');
Route::get('/chart/all/{id}', 'guitsetgelChartController@chartAlljqChart');
// Route::get('/chart/react', 'guitsetgelChartController@chartAllReact');
Route::get('/chart/jqchart', 'guitsetgelChartController@chartAlljqChart');
Route::get('/chart/all/horizontal', 'guitsetgelChartController@getCompaniesChartHorizontal');
Route::get('/test/{id}', 'GuitsetgelController@getGuitsetgelHuvi');
Route::get('/average/chart/{id}', 'GuitsetgelController@generalChart');
Route::get('/report/table', 'GuitsetgelController@getCompanyGuitsetgelTable');
Route::get('/report/table/test/{id}', 'GuitsetgelController@getGuitsetgelTable');
