<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\DonationController;
use App\Http\Controllers\Api\GeneralController;
use App\Http\Controllers\Api\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [LogoutController::class, 'logout']);
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendCode']);
Route::post('/reset-password', [ResetPasswordController::class, 'reset']);

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(ProfileController::class)->group(function (){

        Route::get('/profile-show', 'show');
        Route::put('/profile-update',  'update');
        Route::get('notification-settings', 'getNotificationSettings');
        Route::post('notification-settings',  'updateNotificationSettings');
    });
 
  
});

Route::controller(GeneralController::class)->group(function () {

    Route::get('/blood-types',   'bloodTypes');
    Route::get('/categories',   'categories');
    Route::get('/cities',   'cities');
    Route::get('/governorates',  'governorates');
     Route::middleware('auth:sanctum')->get('/contact-info',  'getInfo');
    Route::get('/aboutapp' , 'about_app');
    Route::get('/settings', 'settings');
   Route::middleware('auth:sanctum')->post('/sendMessage',  'sendMessage');


  
 
});
 


Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/articles', [ArticleController::class, 'index']); 
    Route::get('/article/{id}', [ArticleController::class, 'show']);   
    Route::post('/favorites/{articleId}', [ArticleController::class, 'addToFavorites']);  
    Route::get('/favorites', [ArticleController::class, 'getFavorites']);   
    Route::delete('/favorite/{articleId}', [ArticleController::class, 'removeFromFavorites']);
});
 

Route::middleware('auth:sanctum')->group(function () {
    // إضافة طلب التبرع
    Route::post('/donation-requests', [DonationController::class, 'createDonationRequest']);
    Route::get('/donation-requests', [DonationController::class, 'getDonationRequests']);
    Route::get('/donation-requests/{id}', [DonationController::class, 'showDonationRequest']);

});

  




 