<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Car;
use Inertia\Inertia;
use App\Models\Rental;
use Illuminate\Http\Request;
use function Laravel\Prompts\alert;

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
    public function bookForm(Car $car)
    {
        
        return Inertia::render('Rentals/BookForm',['car'=>$car]);
    }

    public function checkAvailability(Request $request)
{
    $request->validate([
        'car_id' => 'required|exists:cars,id',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    $carId = $request->car_id;
    $start = $request->start_date;
    $end = $request->end_date;

    $overlap = Rental::where('car_id', $carId)
        ->where(function ($query) use ($start, $end) {
            $query->whereBetween('start_date', [$start, $end])
                  ->orWhereBetween('end_date', [$start, $end])
                  ->orWhere(function ($query) use ($start, $end) {
                      $query->where('start_date', '<=', $start)
                            ->where('end_date', '>=', $end);
                  });
        })->exists();

    if ($overlap) {
        return response()->json(['available' => false]);
    }

    $car = Car::findOrFail($carId);
    $days = Carbon::parse($start)->diffInDays(Carbon::parse($end)) + 1;
    $total = $car->price_per_day * $days;

    return response()->json([
        'available' => true,
        'total_cost' => $total
    ]);
}

   public function processBooking(Request $request)
{
    // dd($request->all());

    $request->validate([
        'car_id' => 'required|exists:cars,id',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    // Double-check
    $availability = $this->checkAvailability($request)->getData();
    if (!$availability->available) {
        return back()->withErrors(['message' => 'Car is not available for the selected dates.']);
    }

    Rental::create([
        'user_id' => auth()->id(),
        'car_id' => $request->carId,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'total_cost' => $availability->total_cost,
    ]);

    return redirect()->back()->with('success', 'Car rented successfully!');
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
