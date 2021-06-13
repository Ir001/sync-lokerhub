<?php

use App\Http\Controllers\JsonController;
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
Route::get('/',function(){
    return 1;
});
Route::get('/category',[JsonController::class,'category']);
Route::get('/industry',[JsonController::class,'industry']);
Route::get('/province',[JsonController::class,'province']);
Route::get('/regency',[JsonController::class,'regency']);
Route::get('/pages',[JsonController::class,'pages']);
Route::get('/company',[JsonController::class,'company']);
Route::get('/vacancy',[JsonController::class,'vacancy']);
