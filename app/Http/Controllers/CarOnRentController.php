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

        $bookFullDay = new CarOnRent;
        if ($request->bookFullDay = 'fullDay') {
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
                $bookFullDay = new CarOnRent;
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
                $request->session()->flash('message', 'Your booking has been done for full day');
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
            $request->session()->flash('message', 'This schedule is already booked for half day');
            return redirect('bookCar');
        }

        $bookHalf = new CarOnRent;
        if ($request->bookHalf = 'halfDay') {
            // firstHalf
            if ($request->halfDay = '09:00am To 01:00pm') {
                $if_firstHalf = CarOnRent::where([
                    'cityName' => $request->cityName,
                    'carName' => $request->carName,
                    'bookingDate' => $request->bookingDate
                ])->first();

                if (!empty($if_firstHalf)) {
                    $request->session()->flash('message', 'This schedule is already booked for first half');
                    return redirect('bookCar');
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
                    $request->session()->flash('message', 'Your booking has been done for FIRST HALF');
                    return redirect('viewBooking');
                }
            }

            // secondHalf
            if ($request->halfDay = '02:00pm To 09:00pm') {
                $if_secondHalf = CarOnRent::where([
                    'cityName' => $request->cityName,
                    'carName' => $request->carName,
                    'bookingDate' => $request->bookingDate
                ])->first();

                if (!empty($if_secondHalf)) {
                    $request->session()->flash('message', 'This schedule is already booked for second half');
                    return redirect('bookCar');
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
                    $request->session()->flash('message', 'Your booking has been done for FIRST HALF');
                    return redirect('viewBooking');
                }
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
