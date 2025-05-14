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
//Auth controller for login
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');





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

    Route::get('/listCars',[CarController::class,'listCars'])->name('cars.index');
    Route::get('/cars/create',[CarController::class,'createCar'])->name('cars.create');
    Route::post('/cars/store',[CarController::class,'store'])->name('cars.store');
    Route::get('/showCar/{car}',[CarController::class,'showCar'])->name('cars.show');
    Route::get('/cars/{car}/edit',[CarController::class,'edit'])->name('cars.edit');
    Route::post('/cars/{car}/update',[CarController::class,'update'])->name('cars.update');
    Route::get('/cars/{car}/delete',[CarController::class,'deleteCar'])->name('cars.destroy');

     //rental all URI - read,create,edit,update,delete

    Route::get('/listRentals',[RentalController::class,'rentalList'])->name('rentals.index');
    Route::get('/rentals/create',[RentalController::class,'createRental'])->name('rentals.create');
    Route::post('/rentals/store',[RentalController::class,'store'])->name('rentals.store');
    Route::get('/showRental/{rental}',[RentalController::class,'showRental'])->name('rentals.show');
    Route::get('/rentals/{rental}/edit',[RentalController::class,'edit'])->name('rentals.edit');
    Route::post('/rentals/{rental}/update',[RentalController::class,'update'])->name('rentals.update');
    Route::get('/rentals/{rental}/delete',[RentalController::class,'deleteRental'])->name('rentals.destroy');

});

//Routes exclusively for User only
Route::middleware(['auth', 'RoleMiddleware:user'])->group(function () {

});
