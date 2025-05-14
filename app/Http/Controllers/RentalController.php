<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Inertia\Inertia;
use App\Models\Rental;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function rentalList()
    {
        return Inertia::render('Rentals/RentalList');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createRental()
    {
       $cars=Car::all();
    //    $cars=Car::paginate(6);
        return Inertia::render('Rentals/RentalCreate',['cars'=>$cars]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function showRental(Rental $rental)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rental $rental)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rental $rental)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteRental(Rental $rental)
    {
        //
    }
}
