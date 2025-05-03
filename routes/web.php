<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
});




Route::middleware(['role:admin'])->group(function () {
    // Only users with role 'admin' can access these routes
});

