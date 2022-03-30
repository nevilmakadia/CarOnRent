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
                return redirect('bookCar')->with('message', 'This schedule is already booked for full day');
            } else {
                // $bookFullDay = new CarOnRent;
                $bookFullDay->cityName = $request->cityName;
                $bookFullDay->carName = $request->carName;
                $bookFullDay->bookingDate = $request->bookingDate;
                $bookFullDay->bookingType = $request->bookingType;
                $bookFullDay->halfDay = $request->halfDay;
                $bookFullDay->hourly = $request->hourly;
                $bookFullDay->fromTime = $request->fromTime;
                $bookFullDay->toTime = $request->toTime;
                $bookFullDay->destination = $request->destination;
                $bookFullDay->save();
                return redirect('viewBooking')->with('message', 'Your booking has been done for full day');
            }
        }
        // end of fullDay

        // halfDay
        // bookingType 1 = halfDay
        // halfDay 1 = firstHalf, halfDay 2 = secondHalf
        $if_halfDay = CarOnRent::where([
            'cityName' => $request->cityName,
            'carName' => $request->carName,
            'bookingDate' => $request->bookingDate,
            'bookingType' => '1',
            'halfDay' => '1',
            'halfDay' => '2'
        ])->first();

        if ($if_halfDay != "") {
            return redirect('bookCar')->with('message', 'This schedule is already booked for half day');
        }

        $bookHalf = new CarOnRent;
        if ($request->bookingType == 1) {
            // firstHalf
            if ($request->halfDay == '1') {
                $if_firstHalf = CarOnRent::where([
                    'cityName' => $request->cityName,
                    'carName' => $request->carName,
                    'bookingDate' => $request->bookingDate
                ])->first();

                if ($if_firstHalf) {
                    return redirect('bookCar')->with('message', 'This schedule is already booked for first half');
                } else {
                    // $bookHalf = new CarOnRent;
                    $bookHalf->cityName = $request->cityName;
                    $bookHalf->carName = $request->carName;
                    $bookHalf->bookingDate = $request->bookingDate;
                    $bookHalf->bookingType = $request->bookingType;
                    $bookHalf->halfDay = $request->halfDay;
                    $bookHalf->hourly = $request->hourly;
                    $bookHalf->fromTime = $request->fromTime;
                    $bookHalf->toTime = $request->toTime;
                    $bookHalf->destination = $request->destination;
                    $bookHalf->save();
                    return redirect('viewBooking')->with('message', 'Your booking has been done for FIRST HALF');
                }
            }

            // secondHalf
            if ($request->halfDay == '2') {

                $if_secondHalf = CarOnRent::where([
                    'cityName' => $request->cityName,
                    'carName' => $request->carName,
                    'bookingDate' => $request->bookingDate
                ])->first();

                if ($if_secondHalf) {
                    return redirect('bookCar')->with('message', 'This schedule is already booked for second half');
                } else {
                    $bookHalf = new CarOnRent;
                    $bookHalf->cityName = $request->cityName;
                    $bookHalf->carName = $request->carName;
                    $bookHalf->bookingDate = $request->bookingDate;
                    $bookHalf->bookingType = $request->bookingType;
                    $bookHalf->halfDay = $request->halfDay;
                    $bookHalf->hourly = $request->hourly;
                    $bookHalf->fromTime = $request->fromTime;
                    $bookHalf->toTime = $request->toTime;
                    $bookHalf->destination = $request->destination;
                    $bookHalf->save();
                    return redirect('viewBooking')->with('message', 'Your booking has been done for SECOND HALF');
                }
            }
        }
        // end of hlafDay

        // hourly
        // bookingType 2 = hourly
        // hourly 1 = fromTime, hourly 2 = toTime
        $if_hourly = CarOnRent::where([
            'cityName' => $request->cityName,
            'carName' => $request->carName,
            'bookingDate' => $request->bookingDate,
            'bookingType' => '2'
        ])->first();
        if ($if_hourly != "") {
            return redirect('bookCar')->with('message', 'This schedule is already booked');
        }
        $bookHourly = new CarOnRent;
        if ($request->bookingType == 2) {
            $is_hourly = CarOnRent::where([
                'cityName' => $request->cityName,
                'carName' => $request->carName,
                'bookingDate' => $request->bookingDate
            ])->first();
            if ($is_hourly != "") {
                return redirect('bookCar', 'This schedule is already booked');
                // dd('running');
            } else {
                $bookHourly = new CarOnRent;
                $bookHourly->cityName = $request->cityName;
                $bookHourly->carName = $request->carName;
                $bookHourly->bookingDate = $request->bookingDate;
                $bookHourly->bookingType = $request->bookingType;
                $bookHourly->halfDay = $request->halfDay;
                $bookHourly->hourly = $request->hourly;
                $bookHourly->fromTime = $request->fromTime;
                $bookHourly->toTime = $request->toTime;
                $bookHourly->destination = $request->destination;
                $bookHourly->save();
                return redirect('viewBooking')->with('message', 'Your booking has been done on your time');
            }
        }
        // end of hourly
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
