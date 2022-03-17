<?php

namespace App\Http\Controllers;

use App\Models\CarOnRent;
use Illuminate\Http\Request;
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
        // End Input Validations

        // fullDay - FetchRecord
        $is_fullDay = CarOnRent::where([
            'cityName' => $request->cityName,
            'carName' => $request->carName,
            'bookingDate' => $request->bookingDate,
            'bookingType' => $request->bookingType
        ])->first();

        // fullDay
        if (!empty($is_fullDay)) {
            $request->session()->flash('message', 'Schedual is already booked');
            return redirect('bookCar');
        }
        $book = new CarOnRent();
        if ($book->bookingType = "fullDay") {
            $if_fullDay = CarOnRent::where([
                'cityName' => $book->cityName,
                'carName' => $book->carName,
                'bookingDate' => $book->bookingDate,
                'bookingType' => $book->bookingType
            ])->first();

            if (!empty($if_fullDay)) {
                $request->session()->flash('message', 'Your booking has been done');
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
                $request->session()->flash('message', 'Your booking has been done');
                return redirect('viewBooking');
            }
        }

        // halfDay
        if ($book->bookingType = 'halfDay') {
            $is_halfDay = CarOnRent::where([
                'cityName' => $book->cityName,
                'carName' => $book->carName,
                'bookingDate' => $book->bookingDate,
                'bookingType' => 'halfDay',
                'halfDay' => '09:00am To 01:00pm'
            ])->first();

            if (!empty($is_halfDay)) {
                $request->session()->flash('message', 'This schedual is already booked');
                return redirect('bookCar');
            } else {
                $halfDay1 = [
                    '09:00am To 01:00pm',
                ];
                $halfDay2 = [
                    '02:00am To 09:00pm'
                ];
                if ($book->halfDay = '09:00am To 01:00pm') {
                    $is_valid = CarOnRent::where([
                        'cityName' => $book->cityName,
                        'carName' => $book->carName,
                        'bookingDate' => $book->bookingDate,
                        'bookingType' => $book->bookingType,
                    ])->whereIn('halfDay', $halfDay1)->first();

                    if (!empty($is_valid)) {
                        $request->session()->flash('message', 'This car is already booked');
                        return redirect('bookCar');
                    }

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
                    $request->session()->flash('message', 'Your booking has been done');
                    return redirect('viewBooking');
                } else {
                    $is_valid = CarOnRent::where([
                        'cityName' => $book->cityName,
                        'carName' => $book->carName,
                        'bookingDate' => $book->bookingDate,
                        'bookingType' => $book->bookingType,
                    ])->whereIn('halfDay', $halfDay2)->first();

                    if (!empty($is_valid)) {
                        $request->session()->flash('message', 'This schedual is already booked');
                        return redirect('bookCar');
                    }
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
                    $request->session()->flash('message', 'Your booking has been done');
                    return redirect('viewBooking');
                }
            }
        } elseif ($book->bookingType = 'hourly') {
            if ($book->fromTime > $book->toTime) {
                $request->session()->flash('message', 'Please choose valid time');
                return redirect('bookCar');
            }

            if ($book->fromTime == $book->toTime) {
                $request->session()->flash('message', 'Both time can not be same');
                return redirect('bookCar');
            }

            $is_booked = CarOnRent::where([
                'carName' => $book->carName,
                'cityName' => $book->cityName,
                'bookingDate' => $book->bookingDate,
                'bookingType' => $book->bookingType,
                'fromTime' => $book->fromTime,
                'toTime' > $book->totime
            ])->first();

            if (!empty($is_booked)) {
                $request->session()->flash('message', 'This schedual is already booked');
                return redirect('bookCar');
            } else {
                $hourly1 = [
                    '09:00am To',
                    '10:00am To',
                    '11:00am To',
                    '12:00pm To',
                    '02:00pm To',
                    '03:00pm To',
                    '04:00pm To',
                    '05:00pm To',
                    '06:00pm To',
                    '07:00pm To',
                    '08:00pm To',
                ];

                $hourly2 = [
                    '10:00am To',
                    '11:00am To',
                    '12:00pm To',
                    '03:00pm To',
                    '04:00pm To',
                    '05:00pm To',
                    '06:00pm To',
                    '07:00pm To',
                    '08:00pm To',
                    '09:00pm To'
                ];

                if (in_array($book->fromTime, $hourly1)) {
                    if (in_array($book->toTime, $hourly2)) {
                        $is_booked = CarOnRent::where([
                            'carName' => $book->carName,
                            'cityName' => $book->cityName,
                            'bookingDate' => $book->bookingDate,
                            'bookingType' => 'halfDay'
                        ])->first();
                        if (!empty($is_booked)) {
                            $request->session()->flash('message', 'This schedual is already booked');
                            return redirect('bookCar');
                        }
                    }
                }
            }
        }

        if (in_array($book->fromTime, $hourly1)) {
            if (in_array($book->toTime, $hourly2)) {
                $is_booked = CarOnRent::where([
                    'carName' => $book->carName,
                    'cityName' => $book->cityName,
                    'bookingDate' => $book->bookingDate,
                    'bookingType' => 'halfDay',
                    'halfDay' => '09:00am To 01:00pm'
                ])->first();

                if (!empty($is_booked)) {
                    $request->session()->flash('message', 'This schedual is booking');
                    return redirect('bookCar');
                }
            }
        }
        if (in_array($book->toTime, $hourly2)) {
            if (in_array($book->toTime, $hourly2)) {
                $is_booked = CarOnRent::where([
                    'carName' => $book->carName,
                    'cityName' => $book->cityName,
                    'bookingDate' => $book->bookingDate,
                    'bookingType' => 'halfDay',
                    'halfDay' => '02:00pm To 09:00pm'
                ])->first();
                if (!empty($is_booked)) {
                    $request->session()->flash('message', 'This schedual is booked');
                    return redirect('bookCar');
                }
            }
        }
        $is_hourly = CarOnRent::where([
            'carName' => $book->carName,
            'cityName' => $book->cityName,
            'bookingDate' => $book->bookingDate
        ])->where('hourly', '<', $book->toTime)->get();

        if (!empty($is_hourly)) {
            foreach ($is_hourly as $is_hourly_value) {
                if ($is_hourly_value->toTime > $book->fromTime) {
                    $request->session()->flash('message', 'This schedual is booke');
                    return redirect('bookCar');
                }
            }
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
            $request->session()->flash('message', 'Your booking has been done');
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
            $request->session()->flash('message', 'Your booking has been done');
            return redirect('viewBooking');
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
