<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DashbaordController extends Controller
{
    public function dashboard(){
        return Inertia::render('DashboardPage')
    }
}
