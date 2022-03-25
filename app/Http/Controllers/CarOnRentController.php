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
        return view('bookCar');
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
            'destination' => 'required',
        ]);

        // fullDay
        $if_fullDay = CarOnRent::where([
            'cityName' => $request->cityName,
            'carName' => $request->carName,
            'bookingDate' => $request->bookingDate,
            'bookingType' => 'fullDay'
        ])->first();

        if (!empty($if_fullDay)) {
            $request->session()->flash('message', 'This schedule is already booked for full day');
            return redirect('bookCar');
        }
        $book = new CarOnRent;
        if ($request->bookingType = 'fullDay') {
            $is_fullDay = CarOnRent::where([
                'cityName' => $request->cityName,
                'carName' => $request->carName,
                'bookingDate' => $request->bookingDate,
                // 'bookingType' => 'fullDay'
            ])->first();

            if (!empty($is_fullDay)) {
                $request->session()->flash('message', 'This schedule is already booked for full day');
                return redirect('bookCar');
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
        // end of fullDay

        // halfDay
        $if_halfDay = CarOnRent::where([
            'cityName' => $request->cityName,
            'carName' => $request->carName,
            'bookingDate' => $request->bookingDate,
            'bookingType' => 'halfDay',
            'halfDay' => '09:00am To 01:00pm',
            'halfDay' => '02:00pm To 09:00pm'
        ])->first();

        if (!empty($if_halfDay)) {
            $request->session()->flash('message', 'This schedule is already booked for halfDays');
            return redirect('bookCar');
        }

        $book = new CarOnRent;
        if ($request->bookingType = 'halfDay') {

            // firstHalf
            $first_halfDay = CarOnRent::where([
                'cityName' => $request->cityName,
                'carName' => $request->carName,
                'bookingDate' => $request->bookingDate,
                'bookingType' => 'halfDay',
                'halfDay' => '09:00am To 01:00pm'
            ])->first();

            if (!empty($first_halfDay)) {
                $request->session()->flash('message', 'This schedule is already booked for half day');
                return redirect('bookCar');
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
                $request->session()->flash('message', 'Your booking has been done for half day');
                return redirect('viewBooking');
            }
            // secondHalf
            $second_halfDay = CarOnRent::where([
                'cityName' => $request->cityName,
                'carName' => $request->carName,
                'bookingDate' => $request->bookingDate,
                'bookingType' => 'halfDay',
                'halfDay' => '02:00pm To 09:00pm'
            ])->first();

            if (!empty($second_halfDay)) {
                $request->session()->flash('message', 'This schedule is already booked for half day');
                return redirect('bookCar');
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
                $request->session()->flash('message', 'Your booking has been done for half day');
                return redirect('viewBooking');
            }
        }
        // end of hlafDay
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
