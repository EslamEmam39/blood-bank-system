<?php

use App\Http\Controllers\Admin\ChangePasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
 
use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\GovernorateController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DonationsController;
use App\Http\Controllers\front\ArticleController as FrontArticleController;
use App\Http\Controllers\front\AuthController;
use App\Http\Controllers\front\DonationRequestController;
use App\Http\Controllers\front\FavoriteController;
use App\Http\Controllers\front\LocationController;
use App\Http\Controllers\front\MainController;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Contracts\Role;


  Route::get('/' , [MainController::class,'index'])->name('/');

Route::controller(AuthController::class)->middleware('guest:client')->group(function () {

        Route::get('client/login',  'showLoginForm')->name('client.login');
        Route::post('client/login',  'login');  

        Route::get('client/register',  'showRegisterForm')->name('client.register');
        Route::post('client/register',  'register')->name('client.register.submit');

        Route::get('client/password/forgot',  'showForgotForm')->name('client.password.forgot');
        Route::post('client/password/send-pin', 'sendPin')->name('client.password.sendPin');



Route::get('client/password/verify',   'showVerifyForm')->name('client.password.verify');
Route::post('client/password/reset',   'reset')->name('client.password.reset');
  });
        Route::post('client/logout', [AuthController::class, 'logout'])
        ->middleware('auth:client')
        ->name('client.logout');

        
       //get city by Gonernorate >>
        Route::get('/cities/{governorate_id}', [LocationController::class, 'getCities']);
       


Route::prefix('client')->group(function () {
  
    Route::controller(MainController::class)->group(function(){
 
        Route::get('about-app' , 'about')->name('about.app');
        Route::get('contact-us' , 'getContactUs')->name('contact.us');
        Route::post('contact-us' , 'storeContactUs');

    Route::middleware('auth:client')->group(function ()  { 
        Route::get('/editProfile', 'editProfile')->name('client.profile');
        Route::post('updateProfile' , 'updateProfile')->name('client.profile.update');
    }); 
}); 

    Route::controller(FrontArticleController::class)->group(function (){
        Route::get('/articles/{id}', 'show')->name('article.details');
        Route::get('articles-list' ,  'index')->name('articles.list');
    });

    Route::middleware('auth:client')->group(function () { 

        Route::controller(FavoriteController::class)->group(function () {
            Route::get('/favorites', 'index')->name('favorites.list');
            Route::post('/favorites/add/{articleId}',  'add')->name('favorites.add');
           Route::post('/favorites/remove/{articleId}',  'remove')->name('favorites.remove');
        });
    });


     Route::get('donation-list' , [DonationRequestController::class , 'index'])->name('donation.list');
 Route::get('donation-request/create', [DonationRequestController::class, 'create'])->name('donation.request.create');
Route::post('donation-request/store', [DonationRequestController::class, 'store'])->name('donation.request.store');
Route::get('donation-request/{id}', [DonationRequestController::class, 'show'])->name('donation.request.show');
 
});
 
 
 
 
Route::get('send-mail' , [EmailController::class , 'welcomeEmail']);
 
           // ==================================================================== \\

Auth::routes();


 

Route::prefix('admin')->middleware('auth:web')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('governorates', GovernorateController::class);
        Route::resource('cities', CityController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('articles', ArticleController::class); 
        Route::resource('contact',ContactController::class);
        Route::resource('donations' , DonationsController::class);
        Route::resource('users', UserController::class);
        

        Route::get('roles' , [RoleController::class , 'index'])->name('roles.index');
        route::get('role-create' , [RoleController::class , 'create'])->name('role.create');
        route::post('role-store' , [RoleController::class , 'store'])->name('role.store');
        route::get('role-edit/{id}' , [RoleController::class , 'edit'])->name('role.edit');
        route::put('role-update/{id}' , [RoleController::class , 'update'])->name('role.update');
        Route::delete('role/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');



        Route::get('settings/edit', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
        

        Route::resource('clients', ClientController::class);
        Route::get('clients/{id}/toggle', [ClientController::class, 'toggle'])->name('clients.toggle');

        Route::get('password/change', [ChangePasswordController::class, 'edit'])->name('admin.password.edit');
        Route::put('password/update', [ChangePasswordController::class, 'update'])->name('admin.password.update');


 });
  


