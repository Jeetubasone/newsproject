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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('categorys', [App\Http\Controllers\CategoryController::class, 'searchCategory']);
Route::get('store', [App\Http\Controllers\CategoryController::class, 'store']);
Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'totalDetails']);




Route::get('/add', function () {
    return view('addcategory');
});
Route::post('/add', [App\Http\Controllers\CategoryController::class, 'storeCategory']);
Route::get('categorys/edit/{id}', [App\Http\Controllers\CategoryController::class, 'editCategory']);
Route::put('categorys/edit/{id}', [App\Http\Controllers\CategoryController::class, 'update']);
Route::get('categorys/delete/{id}', [App\Http\Controllers\CategoryController::class, 'destroyCategory']);



Route::get('all-news', [App\Http\Controllers\NewsController::class, 'searchNews']);
Route::get('/addnews', [App\Http\Controllers\NewsController::class, 'create']);
Route::post('/addnews', [App\Http\Controllers\NewsController::class, 'store']);
Route::get('all-news/edit/{id}', [App\Http\Controllers\NewsController::class, 'edit']);
Route::put('all-news/edit/{id}', [App\Http\Controllers\NewsController::class, 'update']);
Route::get('all-news/delete/{id}', [App\Http\Controllers\NewsController::class, 'destroy']);


Route::get('/subcategories', [App\Http\Controllers\CategoryController::class, 'viewSubCategory']);
Route::get('/addsubcategories', [App\Http\Controllers\CategoryController::class, 'viewAddSubCategory']);
Route::post('/addsubcategories', [App\Http\Controllers\CategoryController::class, 'storeSubCategory']);
Route::put('subcategories/edit/{id}', [App\Http\Controllers\CategoryController::class, 'update']);
Route::get('subcategories/delete/{id}', [App\Http\Controllers\CategoryController::class, 'destroySubCategory']);


Route::get('/', [App\Http\Controllers\PublicViewController::class, 'index']);
Route::get('/view', [App\Http\Controllers\PublicViewController::class, 'index']);
Route::get('/categorynews', [App\Http\Controllers\PublicViewController::class, 'categoryNews']);
Route::get('categorynews/{id}', [App\Http\Controllers\PublicViewController::class, 'categoryWiseNewsDetail']);
Route::get('/singlenews', [App\Http\Controllers\PublicViewController::class, 'singleNews']);
Route::get('/singlenews/{id}', [App\Http\Controllers\PublicViewController::class, 'showNewsContent']);

Route::get('/app-settings', [App\Http\Controllers\AppSettingController::class, 'searchAppSetting']);
