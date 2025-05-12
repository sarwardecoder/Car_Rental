<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    /**
     * Display a listing of the cars.
     */
    public function index(Request $request)
    {
        $cars = Car::all();

        return Inertia::render('Cars/Cars', [
            'cars' => $cars
        ]);
    }

    /**
     * Show the form for creating a new car.
     */
    public function create()
    {
        return Inertia::render('Cars/Create');
    }

    /**
     * Store a newly created car in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'image' => 'nullable|string',
            'car_type' => 'required|string',
            'daily_rent_price' => 'required|numeric|min:0',
            'availability' => 'required|boolean',
        ]);

        Car::create($validated);
        return redirect()->route('cars.index')->with('success', 'Car added successfully.');
    }

    /**
     * Show the form for editing a specific car.
     */
    public function edit(Car $car)
    {
        return Inertia::render('Cars/Edit', [
            'car' => $car
        ]);
    }

    /**
     * Update the specified car in storage.
     */
    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'image' => 'nullable|string',
            'car_type' => 'required|string',
            'daily_rent_price' => 'required|numeric|min:0',
            'availability' => 'required|boolean',
        ]);

        $car->update($validated);

        return redirect()->route('cars.index')->with('success', 'Car updated successfully.');
    }

    /**
     * Remove the specified car from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();

        return redirect()->route('cars.index')->with('success', 'Car deleted successfully.');
    }
}
