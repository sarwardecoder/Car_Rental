<?php

use App\Http\Controllers\DashbaordController;
use App\Http\Controllers\RentalController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

Route::get('/', [HomeController::class, 'homePage'])->name('homepage');
Route::get('/contact', [HomeController::class, 'contactUs'])->name('contactUs');
Route::get('/about', [HomeController::class, 'aboutPage'])->name('aboutPage');


Route::get('/dashboard', [DashbaordController::class, 'dashboard'])->name('dashboard');
// All user routes
Route::get('/user/create', [UserController::class, 'userCreate'])->name('user.createform');
Route::post('/user/create', [UserController::class, 'userStore'])->name('user.create');




Route::middleware(['Auth', 'RoleMiddleware:admin'])->group(function () {
    
    Route::get('/rent', action: [RentalController::class, 'rental'])->name('rent');
    
    Route::get('/user/edit/{email}', [UserController::class, 'userEdit'])->name('user.edit');
    Route::get('/user/update/{email}', [UserController::class, 'userUpdate'])->name('user.update');
    Route::get('/user/logout', [UserController::class, 'userLogout'])->name('user.logout');

});

Route::get('/login', [AuthController::class, 'loginPage'])->name('user.login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');


