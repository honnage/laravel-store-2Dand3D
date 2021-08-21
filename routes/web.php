<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TypefileController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\ReportController;

Auth::routes();
Route::get('/',[WelcomeController::class,'index']);
Route::get('search',[WelcomeController::class,'search']);
Route::get('search/category/{id}',[WelcomeController::class,'search_category']);
Route::get('search/formats/{id}',[WelcomeController::class,'search_formats']);
Route::get('search/typefile/{id}',[WelcomeController::class,'search_typefile']);
Route::get('asset/detail/{id}',[AssetController::class,'detail']);
Route::get('/home', [WelcomeController::class,'index'])->name('home');

Route::get('asset',[AssetController::class,'index']);

// must login before
Route::middleware(['auth'])->group(function(){
    Route::get('asset/upload',[AssetController::class,'upload']);                   // AssetController
    Route::post('asset/store',[AssetController::class,'store']);
    Route::get('asset/edit/{id}',[AssetController::class,'edit']);
    Route::post('asset/update/{id}',[AssetController::class, 'update']);
    Route::get('asset/show/{id}',[AssetController::class,'show']);
    Route::get('asset/dashboard/{id}',[AssetController::class,'dashboard_user']);
    Route::post('asset/destroy/{id}',[AssetController::class, 'destroy']);
    Route::get('asset/search/{id}',[AssetController::class, 'user_search_datatable']);

    Route::get('download/asset/{id}',[DownloadController::class,'download']);
    Route::get('users/edit/{id}',[UsersController::class,'edit']);
    Route::post('users/update/{id}',[UsersController::class, 'update']);

    Route::get('report/asset/{id}',[ReportController::class,'report']);   
    Route::post('report/store/{id}',[ReportController::class,'store']);
    Route::get('report/datails/{id}',[ReportController::class,'datails']); 

    Route::get('report/search/{id}',[ReportController::class,'search_datatable']); 
});

//admin path only
Route::middleware(['auth','StatusIS'])->group(function(){
    Route::get('category',[CategoryController::class,'index']);                     // CategoryController
    Route::post('category/store',[CategoryController::class,'store']);
    Route::get('category/edit/{id}',[CategoryController::class,'edit']);
    Route::post('category/update/{id}',[CategoryController::class, 'update']);
    Route::post('category/destroy/{id}',[CategoryController::class, 'destroy']);
    Route::get('category/search/',[CategoryController::class, 'search_datatable']);
 
    Route::get('typefile',[TypefileController::class,'index']);                     // TypefileController
    Route::post('typefile/store',[TypefileController::class,'store']);
    Route::get('typefile/edit/{id}',[TypefileController::class,'edit']);
    Route::post('typefile/update/{id}',[TypefileController::class, 'update']);
    Route::post('typefile/destroy/{id}',[TypefileController::class, 'destroy']);
    Route::get('typefile/search/',[TypefileController::class, 'search_datatable']);

    Route::get('license',[LicenseController::class,'index']);                       // LicenseController
    Route::post('license/store',[LicenseController::class,'store']);
    Route::get('license/edit/{id}',[LicenseController::class,'edit']);
    Route::post('license/update/{id}',[LicenseController::class, 'update']);
    Route::post('license/destroy/{id}',[LicenseController::class, 'destroy']);
    Route::get('license/search/',[LicenseController::class, 'search_datatable']);

    Route::get('asset/dashboard/',[AssetController::class,'dashboard_admin']);  
    Route::get('asset/search/',[AssetController::class,'admin_search_datatable']); 

    Route::get('users',[UsersController::class,'index']);                           // UsersController
    Route::get('users/edit-status/{id}',[UsersController::class,'edit_status']);
    Route::post('users/update/status/{id}',[UsersController::class, 'update_status']);
    Route::get('users/search/',[UsersController::class,'search_datatable']); 

    Route::get('report/edit/{id}',[ReportController::class,'edit']);  
    Route::post('report/edit/show-asset/{id}',[ReportController::class, 'edit_show_asset']);
    
 
});

// TestController
Route::get('test/show-model',[TestController::class,'test_show_model']);
Route::get('test/upload/model',[TestController::class,'test_upload_model']);
Route::post('test/upload/model/single-upload',[TestController::class,'single_upload_model']);
Route::post('test/upload/model/multiple-upload',[TestController::class,'multiple_upload_model']);

Route::get('test/uploadfile',[TestController::class,'test_uploadfile']);
Route::post('test/upload/test/single-upload',[TestController::class,'single_upload']);
Route::post('test/upload/test/multiple-upload',[TestController::class,'multiple_upload']);

