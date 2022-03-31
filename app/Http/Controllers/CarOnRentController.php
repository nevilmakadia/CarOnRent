<?php

namespace App\Http\Controllers;

use App\Models\CarOnRent;
use Illuminate\Http\Request;
use Prophecy\Argument\Token\InArrayToken;
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
        elseif ($request->bookingType == '2') {
            if ($request->fromTime > $request->toTime) {
                return redirect('bookCar')->with('message', 'Please Select Valid Time');
            }
            if ($request->fromTime == $request->toTime) {
                return redirect('bookCar')->with('message', 'Start Time And To Time Can Not Be Same');
            }
            $is_hourly = CarOnRent::where([
                'carName' => $request->carName,
                'cityName' => $request->cityName,
                'bookingDate' => $request->bookingDate,
                'bookingType' => '2',
                'fromTime' => $request->fromTime,
                'toTime' => $request->toTime
            ])->first();

            if ($is_hourly != "") {
                return redirect('bookCar')->with('message', 'This schedule is already booked with another time period');
            } else {
                $fromTime = [
                    '09:00am',
                    '10:00am',
                    '11:00am',
                    '12:00pm',
                    '02:00pm',
                    '03:00pm',
                    '04:00pm',
                    '05:00pm',
                    '06:00pm',
                    '07:00pm',
                    '08:00pm',
                ];
                $toTime = [
                    '10:00am',
                    '11:00am',
                    '12:00pm',
                    '02:00pm',
                    '03:00pm',
                    '04:00pm',
                    '05:00pm',
                    '06:00pm',
                    '07:00pm',
                    '08:00pm',
                    '09:00pm'
                ];

                if (in_array($request->fromTime, $fromTime)) {
                    if (in_array($request->toTime, $toTime)) {
                        $if_booked = CarOnRent::where([
                            'carName' => $request->carName,
                            'cityName' => $request->cityName,
                            'bookingDate' => $request->bookingDate,
                            'bookingType' => '2'
                        ])->first();
                        if ($if_booked != "") {
                            return redirect('bookCar')->with('message', 'This schedule is booked for hourly time period');
                        }
                    }
                }
            }
        }

        if (in_array($request->fromTime, $fromTime)) {
            if (in_array($request->toTime, $toTime)) {
                $if_booked = CarOnRent::where([
                    'carName' => $request->carName,
                    'cityName' => $request->cityName,
                    'bookingDate' => $request->bookingDate,
                    'bookingType' => $request->bookingType,
                    'halfDay' => '1',
                ])->first();
                return redirect('bookCar')->with('message', 'This schedule is already booked for first half period');
            }
        }

        if (in_array($request->fromTime, $toTime)) {
            if (in_array($request->toTime, $toTime)) {
                $if_booked = CarOnRent::where([
                    'carName' => $request->carName,
                    'cityName' => $request->cityName,
                    'bookingDate' => $request->bookingDate,
                    'bookingType' => $request->bookingType,
                    'halfDay' => '2'
                ])->first();
                return redirect('bookCar')->with('message', 'This schedule is already booked for second half period');
            }
        }

        $if_hourly = CarOnRent::where([
            'carName' => $request->carOnrent,
            'cityName' => $request->cityName,
            'bookingDate' => $request->bookingDate
        ])->where('hourly', '<', $request->fromTime)->get();

        if ($if_hourly != "") {
            foreach ($if_hourly as $hourlyValue) {
                
            }
        }
        // hourly
        // bookingType 2 = hourly
        // hourly 1 = fromTime, hourly 2 = toTime

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
