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



// dadaa REPORT
Route::get("/test/table", function(){
  return view("report.companyTableReport");
})->middleware('auth');
Route::get('/show/html', function(){
  return view('report.viewHtml');
})->middleware('auth');
Route::get("/test/fixed/table", function(){
  return view("report.testFixedTable");
})->middleware('auth');
Route::get("/report/print", function(){
  return view('report.printReport'); //123
})->middleware('auth');
Route::get("/pizda/{id}/{workID}", "ExecutionContoller@getLastExecutionByHeseg");
Route::get("/test/{comID}/{workID}", "ExecutionContoller@previousReportExecutionByComIdWorkID");
Route::post('/generate/html', 'reportController@generateHtml');
// dadaa REPORT
Route::get("/autoCombo", function(){
  return view('autoCombo'); //123
})->middleware('auth');

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
Route::post('/companies/delete', 'companyController@delete');
Route::post('/company/get', 'companyController@getCompanies');

Route::post('/companies/storeWorks', 'companyController@storeWorks');
Route::post('/companies/updateWorks', 'companyController@updateWorks');
Route::post('/get/plans/by/companyID', 'planController@getPlanByCompany');

Route::get('/guitsetgel/new', 'ExecutionContoller@executionShow');
Route::post('/guitsetgel/store', 'GuitsetgelController@store');
Route::post('/guitsetgel/update', 'GuitsetgelController@update');
Route::post('/guitsetgel/delete', 'GuitsetgelController@delete');

Route::get('/show/companies/slider', 'companyController@showSlider');


Route::get('/hunHuch/new', 'hunHuchController@index');
Route::post('/hunHuch/new/get', 'hunHuchController@getHunHuchToNew');
Route::post('/hunHuch/store', 'hunHuchController@store');
Route::post('/hunHuch/update', 'hunHuchController@update');
Route::post('/hunHuch/delete', 'hunHuchController@delete');

Route::get('/chart/byDate/{id}/{workType}', 'GuitsetgelController@chartByDateShow');
// Route::get('/chart/all', 'GuitsetgelController@chartAllShow');
Route::get('/chart/all/{id}', 'guitsetgelChartController@chartAlljqChart');
// Route::get('/chart/react', 'guitsetgelChartController@chartAllReact');
Route::get('/chart/jqchart', 'guitsetgelChartController@chartAlljqChart');
Route::get('/chart/all/horizontal', 'guitsetgelChartController@getCompaniesChartHorizontal');
Route::get('/test/{id}', 'GuitsetgelController@getGuitsetgelHuvi');
Route::get('/average/chart/{id}', 'GuitsetgelController@generalChart');
Route::get('/report/table', 'GuitsetgelController@getCompanyGuitsetgelTable');
Route::get('/report/table/test/{id}', 'GuitsetgelController@getGuitsetgelTable');


Route::get('resizeImage', 'ImageController@resizeImage');
Route::get('/image/new', 'ImageController@newImageShow');
Route::post('resizeImagePost', 'ImageController@resizeImagePost')->name('resizeImagePost');

//start Work_type table
Route::get("/work_type/show", "WorktypeController@work_typeShow");
Route::post("/work_type/get", "WorktypeController@getWorkType"); // get json table
Route::post('/work_type/store', 'WorktypeController@store');
Route::post('/work_type/update', 'WorktypeController@update');
Route::post('/work_type/delete', 'WorktypeController@delete');
//end Work_type table

//start Work table
Route::get("/work/show", "WorkController@work_typeShow");
Route::post("/work/get", "WorkController@getWorkType"); // get json table
Route::post('/work/store', 'WorkController@store');
Route::post('/work/update', 'WorkController@update');
Route::post('/work/delete', 'WorkController@delete');
//end Work table

Route::get("/getPlanWorkType", "planController@getPlanWorkTypeByCompany");
Route::get("/getPlanWork/company/work_type", "planController@getPlanWorksByWorkTypeID");

Route::post("/execution/store", "ExecutionContoller@store");
Route::post('/execution/execUpdate', "ExecutionContoller@execUpdate");
Route::post('/execution/execDelete', "ExecutionContoller@execDelete");

Route::post('/guitsetgel/getExecByCompany', "ExecutionContoller@getExecByCompany");

// workType Visible start
Route::get('workType/visible', "WorktypeController@visibleShowBlade");
Route::get('workType/visibleChange', "WorktypeController@ChangeWorkTypeVisible");
Route::get('workType/getCheck', "WorktypeController@getWorkTypeVisible");
Route::get('works/checkStroe', "WorktypeController@ChangeWorksVisible");
// workType Visible end

//log view
Route::get('/viewLog', 'logsController@index');
Route::post('/logView/getTableLog', 'logsController@getTableLog');
