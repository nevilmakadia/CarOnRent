<?php

namespace App\Http\Controllers;

use App\Models\CarOnRent;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;
use Symfony\Component\Console\Input\Input;

class CarOnRentController extends Controller
{
    public function index()
    {
        // 
    }

    public function create()
    {
        return view('bookCar');
    }

    public function store(Request $request)
    {
        // Input Validations
        $request->validate([
            'cityName' => 'required',
            'carName' => 'required',
            'bookingDate' => 'required',
            'bookingType' => 'required'
        ]);

        // fullDay
        $if_fullDay = CarOnRent::where([
            'cityName' => $request->cityName,
            'carName' => $request->carName,
            'bookingDate' => $request->bookingDate,
            'bookingType' => 'fullDay'
        ])->first();
        
        if (!empty($if_fullDay)) {
            $request->session()->flash('message', 'This schedule is already booked');
            return redirect('bookCar');
            dd('running');
        }
        $newBooking = new CarOnRent;
        if ($request->bookingType == 'fullDay') {

            $if_fullDay = CarOnRent::where([
                'cityName' => $request->cityName,
                'carName' => $request->carName,
                'bookingDate' => $request->bookingDate,
            ])->first();

            if (!empty($if_fullDay)) {
                $request->session()->flash('message', 'Your booking has been done for FULL DAY');
                return redirect('viewBooking');
            } else {
                $newBooking = new CarOnRent;
                $newBooking->cityName = $request->cityName;
                $newBooking->carName = $request->carName;
                $newBooking->bookingDate = $request->bookingDate;
                $newBooking->bookingType = $request->bookingType;
                $newBooking->halfDay = $request->halfDay;
                $newBooking->hourly = $request->hourly;
                $newBooking->fromTime = $request->fromTime;
                $newBooking->toTime = $request->toTime;
                $newBooking->destination = $request->destination;
                $newBooking->save();
                return redirect('viewBooking');
            }
        }
    }

    public function show(CarOnRent $carOnRent)
    {
        return view('viewBooking')->with('carArray', CarOnRent::all());
    }

    public function edit(CarOnRent $carOnRent)
    {
        //
    }

    public function update(Request $request, CarOnRent $carOnRent)
    {
        //
    }

    public function destroy(CarOnRent $carOnRent, $id)
    {
        CarOnRent::destroy(array('id', $id));
        return redirect('viewBooking');
    }
}
