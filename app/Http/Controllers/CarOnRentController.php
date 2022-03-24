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
            'bookingType' => 'required',
            'destination' => 'required'
        ]);

        // fullDay
        $if_fullDay = CarOnRent::where([
            'cityName' => $request->cityName,
            'carName' => $request->carName,
            'bookingDate' => $request->bookingDate,
<<<<<<< HEAD
            'bookingType' => 'fullDay'
=======
            'bookingType' => $request->bookingType,
            'destination' => $request->destination
>>>>>>> parent of 760760d (Book Condition)
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
<<<<<<< HEAD
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
=======
                $request->session()->flash('message', 'Your booking has been done for full day');
                return redirect('viewBooking');
            } else {
                $book = new CarOnRent;
                $book->cityName = $request->cityName;
                $book->carName = $request->carName;
                $book->bookingDate = $request->bookingDate;
                $book->bookingType = $request->bookingType;
                $book->halfDay = $request->halfDay;
                $book->hourly = $request->hourly;
                $book->fromTime = $request->fromTime;
                $book->toTime = $request->toTime;
                $book->destination = $request->destination;
                $book->save();
                $request->session()->flash('message', 'Your booking has been done for full day.');
                return redirect('viewBooking');
            }
        }

        // $res->cityName = $request->input('cityName');
        // $res->carName = $request->input('carName');
        // $res->bookingDate = $request->input('bookingDate');
        // $res->bookingType = $request->input('bookingType');
        // $res->halfDay = $request->input('halfDay');
        // $res->hourly = $request->input('hourly');
        // $res->fromTime = $request->input('fromTime');
        // $res->toTime = $request->input('toTime');
        // $res->destination = $request->input('destination');
        // $res->save();

        // $request->session()->flash('message', 'Your booking has been confirmed.');
        // return redirect('viewBooking');
>>>>>>> parent of 760760d (Book Condition)
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
