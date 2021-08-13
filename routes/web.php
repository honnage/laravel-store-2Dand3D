<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TypefileController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AssetController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// UsersController
Route::get('users',[UsersController::class,'index']);

// CategoryController
Route::get('category',[CategoryController::class,'index']);
Route::post('category/store',[CategoryController::class,'store']);
Route::get('category/edit/{id}',[CategoryController::class,'edit']);
Route::post('category/update/{id}',[CategoryController::class, 'update']);
Route::post('category/destroy/{id}',[CategoryController::class, 'destroy']);
Route::get('category/search/',[CategoryController::class, 'search_datatable']);

// TypefileController
Route::get('typefile',[TypefileController::class,'index']);
Route::post('typefile/store',[TypefileController::class,'store']);
Route::get('typefile/edit/{id}',[TypefileController::class,'edit']);
Route::post('typefile/update/{id}',[TypefileController::class, 'update']);
Route::post('typefile/destroy/{id}',[TypefileController::class, 'destroy']);
Route::get('typefile/search/',[TypefileController::class, 'search_datatable']);

// LicenseController
Route::get('license',[LicenseController::class,'index']);
Route::post('license/store',[LicenseController::class,'store']);
Route::get('license/edit/{id}',[LicenseController::class,'edit']);
Route::post('license/update/{id}',[LicenseController::class, 'update']);
Route::post('license/destroy/{id}',[LicenseController::class, 'destroy']);
Route::get('license/search/',[LicenseController::class, 'search_datatable']);

// AssetController
Route::get('asset',[AssetController::class,'index']);
Route::post('asset/upload',[AssetController::class,'upload']);
Route::get('asset/edit/{id}',[AssetController::class,'edit']);
Route::post('asset/update/{id}',[AssetController::class, 'update']);
Route::post('asset/destroy/{id}',[AssetController::class, 'destroy']);
Route::get('asset/search/',[AssetController::class, 'search_datatable']);
