<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TypefileController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('category',[CategoryController::class,'index']);
Route::post('category/store',[CategoryController::class,'store']);
Route::get('category/edit/{id}',[CategoryController::class,'edit']);
Route::post('category/update/{id}',[CategoryController::class, 'update']);
Route::post('category/destroy/{id}',[CategoryController::class, 'destroy']);
Route::get('category/search/',[CategoryController::class, 'search_datatable']);

Route::get('typefile',[TypefileController::class,'index']);
Route::post('typefile/store',[TypefileController::class,'store']);
Route::get('typefile/edit/{id}',[TypefileController::class,'edit']);
Route::post('typefile/update/{id}',[TypefileController::class, 'update']);
Route::post('typefile/destroy/{id}',[TypefileController::class, 'destroy']);
Route::get('typefile/search/',[TypefileController::class, 'search_datatable']);
