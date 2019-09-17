<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/get-weekly-sales','Api\ReportController@getWeeklySales');
Route::get('/get-monthly-sales','Api\ReportController@getMonthlySales');
Route::post('/get-sales-report','Api\ReportController@getSalesReport');
Route::post('/get-alltime-salers','Api\ReportController@AllTimeBestSeller');
Route::post('/get-latest-salers','Api\ReportController@LatestBestSeller');
Route::post('/get-month-salers','Api\ReportController@MonthBestSeller');
Route::post('/get-year-salers','Api\ReportController@YearBestSeller');
Route::get('/update-menu-weight','Api\UpdateController@updateMenuWeight');
Route::get('/get-today-logs','Api\LogController@TodayLog');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


