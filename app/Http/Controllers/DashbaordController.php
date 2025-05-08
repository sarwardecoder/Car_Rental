<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;

class DashbaordController extends Controller
{
    public function dashboard(Request $request){ 
    $users=User::all();
// dd(typeOf($users));
// $type = gettype($users);
// dd($type);
        return Inertia::render('DashboardPage',[
            'users'=>$users //user props
        ]);


    }
}
