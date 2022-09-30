<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [App\Http\Controllers\UserController::class, 'userLogin']);

Route::post('categorys', [App\Http\Controllers\CategoryController::class, 'searchCategory']);
Route::resource('category', App\Http\Controllers\CategoryController::class)->only(['store','destroy','show','update']);

Route::post('all-news', [App\Http\Controllers\NewsController::class, 'searchNews']);
Route::resource('news', App\Http\Controllers\NewsController::class)->only(['store','destroy','show']);
Route::post('news-update/{id?}', [App\Http\Controllers\NewsController::class, 'update']); 

Route::post('app-settings', [App\Http\Controllers\AppSettingController::class, 'searchAppSetting']);
Route::resource('app-setting', App\Http\Controllers\AppSettingController::class)->only(['store','destroy','show']);
Route::post('app-setting-update/{id?}', [App\Http\Controllers\AppSettingController::class, 'update']); 

Route::post('advertisements', [App\Http\Controllers\AdvertisementController::class, 'searchAdvertisement']);
Route::resource('advertisement', App\Http\Controllers\AdvertisementController::class)->only(['store','destroy','show']);
Route::post('advertisement-update/{id?}', [App\Http\Controllers\AdvertisementController::class, 'update']); 


Route::post('newslatters', [App\Http\Controllers\NewslatterController::class, 'searchNewslatters']);
Route::resource('newslatter', App\Http\Controllers\NewslatterController::class)->only(['store','destroy','show','update']);


Route::post('total-details', [App\Http\Controllers\DashboardController::class, 'totalDetails']);
Route::post('categorywise-details', [App\Http\Controllers\DashboardController::class, 'categoryWiseNews']);



