<?php

use App\Http\Controllers\Admin\ChangePasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
 use App\Http\Controllers\front\AuthController;
use App\Http\Controllers\front\DonationRequestController;
use App\Http\Controllers\front\LocationController;
use App\Http\Controllers\front\MainController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\GovernorateController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DonationsController;
use Spatie\Permission\Contracts\Role;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('client/login', [AuthController::class, 'showLoginForm'])
    ->middleware('guest:client')
    ->name('client.login');

Route::post('client/login', [AuthController::class, 'login']);  

Route::get('client/register', [AuthController::class, 'showRegisterForm'])
    ->middleware('guest:client')
    ->name('client.register');

Route::post('client/register', [AuthController::class, 'register'])
    ->name('client.register.submit');

Route::post('client/logout', [AuthController::class, 'logout'])
    ->middleware('auth:client')
    ->name('client.logout');
 
 Route::get('/cities/{governorate_id}', [LocationController::class, 'getCities']);

Route::controller(MainController::class)->group(function(){
 Route::get('/' , 'index')->name('/');

 Route::get('about-app' , 'about')->name('about.app');

 Route::get('contact-us' , 'getContactUs')->name('contact.us');
 Route::post('contact-us' , 'storeContactUs');

 Route::get('/editProfile', 'editProfile')->name('client.profile');
 Route::post('updateProfile' , 'updateProfile')->name('client.profile.update');

});
 Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('article.details');

 Route::get('donation-request' , [DonationRequestController::class , 'index'])->name('donation.request');

 

 
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
  


