<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

Route::get('/', [HomeController::class,'homePage']);

// All user routes
Route::get('/user/create', [UserController::class,'userCreate'])->name('user.create');
Route::get('/user/update/{id}', [UserController::class,'userUpdate'])->name('user.update');
Route::get('/user/logout', [UserController::class,'userLogout'])->name('user.logout');




Route::middleware(['Auth','RoleMiddleware:admin'])->group(function () {
    
    
    
});

Route::get('/user/login', [AuthController::class,'loginPage'])->name('user.login');
Route::post('/user/login', [AuthController::class,'login'])->name('login.post');


