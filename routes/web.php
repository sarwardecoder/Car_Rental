<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['role:admin'])->group(function () {
    // Only users with role 'admin' can access these routes
});

