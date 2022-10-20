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
Route::get('/categorys', [App\Http\Controllers\CategoryController::class, 'searchCategory']);
Route::get('/store', [App\Http\Controllers\CategoryController::class, 'store']);
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'totalDetails']);


//  Route::middleware(['auth', 'auth.session'])->group(function () {

// Route::get('/add', function () {
//     return view('addcategory');
// });
Route::get('/add', [App\Http\Controllers\CategoryController::class, 'viewAddCategory']);
Route::post('/add', [App\Http\Controllers\CategoryController::class, 'storeCategory']);
Route::get('/categorys/edit/{id}', [App\Http\Controllers\CategoryController::class, 'editCategory']);
Route::put('/categorys/edit/{id}', [App\Http\Controllers\CategoryController::class, 'update']);
Route::get('/categorys/delete/{id}', [App\Http\Controllers\CategoryController::class, 'destroyCategory']);



Route::get('all-news', [App\Http\Controllers\NewsController::class, 'searchNews']);
Route::get('/addnews', [App\Http\Controllers\NewsController::class, 'create']);
Route::post('/addnews', [App\Http\Controllers\NewsController::class, 'store']);
Route::get('/all-news/edit/{id}', [App\Http\Controllers\NewsController::class, 'edit']);
Route::put('/all-news/edit/{id}', [App\Http\Controllers\NewsController::class, 'update']);
Route::get('/all-news/delete/{id}', [App\Http\Controllers\NewsController::class, 'destroy']);


Route::get('/subcategories', [App\Http\Controllers\CategoryController::class, 'viewSubCategory']);
Route::get('/addsubcategories', [App\Http\Controllers\CategoryController::class, 'viewAddSubCategory']);
Route::post('/addsubcategories', [App\Http\Controllers\CategoryController::class, 'storeSubCategory']);
Route::get('/subcategories/edit/{id}', [App\Http\Controllers\CategoryController::class, 'editSubcategory']);
Route::put('/subcategories/edit/{id}', [App\Http\Controllers\CategoryController::class, 'update']);
Route::get('/subcategories/delete/{id}', [App\Http\Controllers\CategoryController::class, 'destroySubCategory']);

// });
Route::get('/', [App\Http\Controllers\PublicViewController::class, 'index']);
Route::get('/view', [App\Http\Controllers\PublicViewController::class, 'index']);
Route::get('/categorynews', [App\Http\Controllers\PublicViewController::class, 'categoryNews']);
Route::get('/categorynews/{id}', [App\Http\Controllers\PublicViewController::class, 'categoryWiseNewsDetail']);
Route::get('/singlenews', [App\Http\Controllers\PublicViewController::class, 'singleNews']);
Route::get('/singlenews/{id}', [App\Http\Controllers\PublicViewController::class, 'showNewsContent']);

Route::post('/newslatters', [App\Http\Controllers\NewslatterController::class, 'store']);

// Route::get('/addappsetting', function () {
//     return view('/addappsetting');
// });
Route::get('/addappsetting/edit/{id}', [App\Http\Controllers\AppSettingController::class, 'show']);
Route::put('/addappsetting/edit/{id}', [App\Http\Controllers\AppSettingController::class, 'update']);

Route::get('/ads', [App\Http\Controllers\AdvertisementController::class, 'create']);
Route::post('/addads', [App\Http\Controllers\AdvertisementController::class, 'store']);


// Route::get('/contact', function () {
//     return view('contact');
// });
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'create']);
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store']);
Route::get('/login', function () {
    return view('/login');
});
Route::post('/login', [App\Http\Controllers\UserController::class, 'userLogin']);
