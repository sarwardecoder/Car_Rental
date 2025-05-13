<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\DashbaordController;

Route::get('/', [HomeController::class, 'homePage'])->name('homepage');
Route::get('/contact', [HomeController::class, 'contactUs'])->name('contactUs');
Route::get('/about', [HomeController::class, 'aboutPage'])->name('aboutPage');


Route::get('/dashboard', [DashbaordController::class, 'dashboard'])->name('dashboard');
Route::get('/user/dashboard', [DashbaordController::class, 'userDashboard'])->name('userDashboard');
// All user routes
Route::get('/user/create', [UserController::class, 'userCreate'])->name('user.createform');
Route::post('/user/create', [UserController::class, 'userStore'])->name('user.create');


Route::middleware(['auth'])->group(function () {
//edit form open
    Route::get('/user/edit/{id}', [UserController::class, 'edit']);
    Route::put('/user/update/{id}', [UserController::class, 'update']);
    Route::delete('/user/delete/{id}', [UserController::class, 'userDelete']);

    Route::get('/user/logout', [UserController::class, 'userLogout'])->name('logout');


});

Route::middleware(['auth', 'RoleMiddleware:admin'])->group(function () {

    Route::get('/rental', action: [RentalController::class, 'rental'])->name('rent');


    //Car all URI - read,create,edit,update,delete
    // Route::resource('/cars', CarController::class);

    Route::get('/listCars',[CarController::class,'listCars'])->name('cars.index');
    Route::get('/cars/{car}/edit',[CarController::class,'edit'])->name('cars.edit');
    Route::put('/cars/{car}/update',[CarController::class,'update'])->name('cars.update');
    // Route::delete('/cars/{car}',[CarController::class,'destroy'])->name('cars.destroy');
    Route::get('/cars/delete',[CarController::class,'deleteCar'])->name('cars.destroy');



});

Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');


