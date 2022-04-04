<?php

namespace App\Http\Controllers;

use App\Models\CarOnRent;
use Illuminate\Http\Request;

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
        // bookingtType 0 = fullDay
        $if_fullDay = CarOnRent::where([
            'cityName' => $request->cityName,
            'carName' => $request->carName,
            'bookingDate' => $request->bookingDate,
            'bookingType' => '0'
        ])->first();
        if ($if_fullDay != "") {
            return redirect('bookCar')->with('message', 'This schedule is already booked for full day');
        }
        $bookFullDay = new CarOnRent;
        if ($request->bookingType == 0) {
            $is_fullDay = CarOnRent::where([
                'cityName' => $request->cityName,
                'carName' => $request->carName,
                'bookingDate' => $request->bookingDate
            ])->first();
            if ($is_fullDay != "") {
                return redirect('bookCar')->with('message', 'This schedule is already booked for another session');
            } else {
                // $bookFullDay = new CarOnRent;
                $bookFullDay->cityName = $request->cityName;
                $bookFullDay->carName = $request->carName;
                $bookFullDay->bookingDate = $request->bookingDate;
                $bookFullDay->bookingType = $request->bookingType;
                $bookFullDay->halfDay = $request->halfDay;
                $bookFullDay->hourly = $request->fromTime . " " . $request->toTime;
                $bookFullDay->fromTime = $request->fromTime;
                $bookFullDay->toTime = $request->toTime;
                $bookFullDay->destination = $request->destination;
                $bookFullDay->save();
                return redirect('viewBooking')->with('message', 'Your booking has been done for full day');
            }
        }
        // end of fullDay ----------------------------------------------------------------------------------------------------------

        // halfDay
        $bookHalf = new CarOnRent;
        if ($request->bookingType == 1) {
            $if_halfDay = CarOnRent::where([
                'cityName' => $request->cityName,
                'carName' => $request->carName,
                'bookingDate' => $request->bookingDate,
                'bookingType' => $request->bookingType,
                'halfDay' => $request->halfDay,
            ])->first();
            if ($if_halfDay) {
                return redirect('bookCar')->with('message', 'This schedule is already booked for Half Day');
            } else {
                $bookHalf->cityName = $request->cityName;
                $bookHalf->carName = $request->carName;
                $bookHalf->bookingDate = $request->bookingDate;
                $bookHalf->bookingType = $request->bookingType;
                $bookHalf->halfDay = $request->halfDay;
                $hours = explode(" ", $request->halfDay);
                $bookHalf->hourly = $request->fromTime . " " . $request->toTime;
                $bookHalf->fromTime = $hours[0];
                $bookHalf->toTime = $hours[1];
                $bookHalf->destination = $request->destination;
                $bookHalf->save();
                return redirect('viewBooking')->with('message', 'Your booking has been done for HALF DAY');
            }
        }
        // end of halfDay ----------------------------------------------------------------------------------------------------------

        // hourly
        // bookingType 2 = hourly
        // hourly 1 = fromTime, hourly 2 = toTime
        $bookHourly = new CarOnRent;
        if ($request->bookingType == 2) {
            $if_hourly = CarOnRent::where([
                'cityName' => $request->cityName,
                'carName' => $request->carName,
                'bookingDate' => $request->bookingDate,
                'bookingType' => $request->bookingType,
                // 'hourly' => $request->hourly,
                'fromTime' => $request->fromTime,
                'toTime' => $request->toTime
            ])->first();
            if ($if_hourly) {
                return redirect('bookCar')->with('message', 'This schedule is already booked for this hourly session');
            } elseif ($request->fromTime > $request->toTime) {
                return redirect('bookCar')->with('message', 'END time shoud be GREATER than START time');
            } elseif ($request->fromTime == $request->toTime) {
                return redirect('bookCar')->with('message', 'START TIME or END TIME can not be same');
            } else {
                $bookHourly = new CarOnRent;
                $bookHourly->cityName = $request->cityName;
                $bookHourly->carName = $request->carName;
                $bookHourly->bookingDate = $request->bookingDate;
                $bookHourly->bookingType = $request->bookingType;
                $bookHourly->halfDay = $request->halfDay;
                $bookHourly->hourly = $request->fromTime . " " . $request->toTime;
                $bookHourly->fromTime = $request->fromTime;
                $bookHourly->toTime = $request->toTime;
                $bookHourly->destination = $request->destination;
                $bookHourly->save();
                return redirect('viewBooking')->with('message', 'Your booking has been done for HOURLY');
            }
        }
        // end of hourly -----------------------------------------------------------------------------------------------------------
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
        return redirect('viewBooking')->with('message2', 'Record Deleted Successfully');
    }
}
