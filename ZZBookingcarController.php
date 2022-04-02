<?php

namespace App\Http\Controllers;

use App\Models\CarOnRent;
use Error;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class CarOnRentController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        //validatesan
        $request->validate([
            'booking_citys' => 'Required',
            'booking_cars' => 'Required',
            'booking_date' => 'Required',
            'booking_destination' => 'Required',
        ]);
        //-----------------------------------------------------------------------------------------------


        //full day booking data     
        $is_fullday = CarOnRent::where([
            'citys_name' => $request->booking_citys,
            'cars_name' => $request->booking_cars,
            'pickup_date' => $request->booking_date,
            'booking_type' => 'Fullday'
        ])->first();

        //Fullday code  
        if (!empty($is_fullday)) {
            $error = "car is already booked for full day";
            return Redirect()->route('index')->withErrors([$error]);
        }
        $booking = new CarOnRent;
        if ($request->booking == 'Fullday') {
            $is_fullday = CarOnRent::where([
                'citys_name' => $request->booking_citys,
                'cars_name' => $request->booking_cars,
                'pickup_date' => $request->booking_date,
            ])->first();


            if (!empty($is_fullday)) {
                $error = " You car is booked fullday";
                return Redirect()->route('index')->withErrors([$error]);
            } else {

                $booking = new CarOnRent;
                $booking->citys_name = $request->booking_citys;
                $booking->cars_name = $request->booking_cars;
                $booking->pickup_date = $request->booking_date;
                $booking->destination = $request->booking_destination;
                $booking->booking_type = $request->booking;
                $booking->half_day = $request->booking_halfday;
                $booking->hourly = $request->booking_hourlytwo;
                $booking->hourly_to = $request->booking_hourlythree;
                $booking->save();
                return redirect()->route('index');
            }
        }


        //----------------------------------------------------------------------------------------       
        //halfday booking


        if ($request->booking == 'Halfday') {

            $is_Halfday = CarOnRent::where([
                'citys_name' => $request->booking_citys,
                'cars_name' => $request->booking_cars,
                'pickup_date' => $request->booking_date,
                'booking_type' => 'Halfday',
                'half_day' => $request->booking_halfday
            ])->first();



            if (!empty($is_Halfday)) {
                $error = "car is already booked for Halfday";
                return Redirect()->route('index')->withErrors([$error]);
            } else {
                $array1 = [
                    '08:00',
                    '09:00',
                    '10:00',
                    '11:00',
                    '12:00',
                    '13:00',
                ];

                $array2 = [
                    '14:00',
                    '15:00',
                    '16:00',
                    '17:00',
                    '18:00',
                    '19:00',
                    '20:00',
                    '21:00',
                ];

                if ($request->booking_halfday == "8:00 to 13:00") {
                    $is_valid = CarOnRent::where([
                        'citys_name' => $request->booking_citys,
                        'cars_name' => $request->booking_cars,
                        'pickup_date' => $request->booking_date,
                        'booking_type' => 'Hourly'
                    ])->whereIn('hourly', $array1)
                        ->first();
                    if (!empty($is_valid)) {
                        $error = "Car is already booked for hourly  this time period";
                        return Redirect()->route('index')->withErrors([$error]);
                    }
                    $booking = new CarOnRent;
                    $booking->citys_name = $request->booking_citys;
                    $booking->cars_name = $request->booking_cars;
                    $booking->pickup_date = $request->booking_date;
                    $booking->destination = $request->booking_destination;
                    $booking->booking_type = $request->booking;
                    $booking->half_day = $request->booking_halfday;
                    $booking->hourly = $request->booking_hourlytwo;
                    $booking->hourly_to = $request->booking_hourlythree;
                    $booking->save();
                    return redirect()->route('index');
                } else {

                    $is_valid = CarOnRent::where([
                        'cars_name' => $request->booking_cars,
                        'citys_name' => $request->booking_citys,
                        'pickup_date' => $request->booking_date,
                        'booking_type' => 'Hourly'
                    ])->whereIn('hourly_to', $array2)
                        ->first();

                    if (!empty($is_valid)) {

                        $error = "Car is already booked for second half period this time period";
                        return Redirect()->route('index')->withErrors([$error]);
                    }
                    $booking = new CarOnRent;
                    $booking->citys_name = $request->booking_citys;
                    $booking->cars_name = $request->booking_cars;
                    $booking->pickup_date = $request->booking_date;
                    $booking->destination = $request->booking_destination;
                    $booking->booking_type = $request->booking;
                    $booking->half_day = $request->booking_halfday;
                    $booking->hourly = $request->booking_hourlytwo;
                    $booking->hourly_to = $request->booking_hourlythree;
                    $booking->save();
                    return redirect()->route('index');
                }
            }

            //-----------------------------------------------------------------------------------------------
            //-----------------------------------------------------------------------------------------------

        } elseif ($request->booking == 'Hourly') {
            if ($request->booking_hourlytwo > $request->booking_hourlythree) {
                $error = "plese select from time greater than to time";
                return Redirect()->route('index')->withErrors([$error]);
            }
            if ($request->booking_hourlytwo == $request->booking_hourlythree) {
                $error = "from time to time must be deferent ";
                return Redirect()->route('index')->withErrors([$error]);
            }
            $is_booked = CarOnRent::where([

                'cars_name' => $request->booking_cars,
                'citys_name' => $request->booking_citys,
                'pickup_date' => $request->booking_date,
                'booking_type' => 'Hourly',
                'hourly' => $request->booking_hourlytwo,
                'hourly_to' => $request->booking_hourlythree

            ])->first();

            if (!empty($is_booked)) {

                $error = "Car is already booked for this hourly time period";
                return Redirect()->route('index')->withErrors([$error]);
            } else {
                $array1 = [
                    '08:00',
                    '09:00',
                    '10:00',
                    '11:00',
                    '12:00',
                    '13:00',
                ];

                $array2 = [
                    '14:00',
                    '15:00',
                    '16:00',
                    '17:00',
                    '18:00',
                    '19:00',
                    '20:00',
                    '21:00',
                ];

                if (in_array($request->booking_hourlytwo, $array1)) {
                    if (in_array($request->booking_hourlythree, $array2)) {

                        $is_booked = CarOnRent::where([
                            'cars_name' => $request->booking_cars,
                            'citys_name' => $request->booking_citys,
                            'pickup_date' => $request->booking_date,
                            'booking_type' => 'Halfday',
                        ])->first();
                        if (!empty($is_booked)) {
                            $error = "this car is booked for any half day this time";
                            return Redirect()->route('index')->withErrors([$error]);
                        }
                    }
                }
            }
        }
        //------------------------------------------------------------------------------------------------
        
        //------------------------------------------------------------------------------------------------

        if (in_array($request->booking_hourlytwo, $array1)) {

            if (in_array($request->booking_hourlythree, $array2)) {

                $is_booked = CarOnRent::where([
                    'cars_name' => $request->booking_cars,
                    'citys_name' => $request->booking_citys,
                    'pickup_date' => $request->booking_date,
                    'booking_type' => 'Halfday',
                    'half_day' => '8:00 to 13:00'
                ])->first();

                if (!empty($is_booked)) {
                    $error = "this car is booked for morning halfday";
                    return Redirect()->route('index')->withErrors([$error]);
                }
            }
        }

        if (in_array($request->booking_hourlytwo, $array2)) {
            if (in_array($request->booking_hourlythree, $array2)) {

                $is_booked = CarOnRent::where([
                    'cars_name' => $request->booking_cars,
                    'citys_name' => $request->booking_citys,
                    'pickup_date' => $request->booking_date,
                    'booking_type' => 'Halfday',
                    'half_day' => '14:30 to 21:00'
                ])->first();

                if (!empty($is_booked)) {
                    $error = "this car is booked for evening halfday";
                    return Redirect()->route('index')->withErrors([$error]);
                }
            }
        }
        $is_hourly = CarOnRent::where([
            'cars_name' => $request->booking_cars,
            'citys_name' => $request->booking_citys,
            'pickup_date' => $request->booking_date,
        ])
            ->where('hourly', '<', $request->booking_hourlythree)
            ->get();

        if (!empty($is_hourly)) {
            foreach ($is_hourly as $is_hourly_value) {
                if ($is_hourly_value->hourly_to > $request->booking_hourlytwo) {

                    $error = "car is already booked for this hours";
                    return Redirect()
                        ->route('index')
                        ->withErrors([$error]);
                }
            }
            $booking = new CarOnRent;
            $booking->citys_name = $request->booking_citys;
            $booking->cars_name = $request->booking_cars;
            $booking->pickup_date = $request->booking_date;
            $booking->destination = $request->booking_destination;
            $booking->booking_type = $request->booking;
            $booking->half_day = $request->booking_halfday;
            $booking->hourly = $request->booking_hourlytwo;
            $booking->hourly_to = $request->booking_hourlythree;
            $booking->save();
            return redirect()->route('index');
        } else {

            $booking = new CarOnRent;
            $booking->citys_name = $request->booking_citys;
            $booking->cars_name = $request->booking_cars;
            $booking->pickup_date = $request->booking_date;
            $booking->destination = $request->booking_destination;
            $booking->booking_type = $request->booking;
            $booking->half_day = $request->booking_halfday;
            $booking->hourly = $request->booking_hourlytwo;
            $booking->hourly_to = $request->booking_hourlythree;
            $booking->save();
            return redirect()->route('index');
        }

        $error =  "error";
        return Redirect()->route('index')->withErrors([$error]);
    }


    public function show()
    {
        $carbook = CarOnRent::all();
        // dd($carbook);
        return view('create', compact('carbook'));
    }

    public function edit($id)
    {
        // $carbook = CarOnRent::find($id);
        // return view('edit',compact('carbook'));

    }

    public function update(Request $request, $id)
    {
        // $carbook = CarOnRent::find($id);
        // $carbook->citys_name = $request->booking_citys;
        // $carbook->cars_name = $request->booking_cars;
        // $carbook->pickup_date = $request->booking_date;
        // $carbook->destination = $request->booking_destination;
        // $carbook->booking_type = $request->booking_fullday;
        // $carbook->half_day = $request->booking_halfday;
        // $carbook->hourly = $request->booking_hourly;
        // $carbook->save();

        // return redirect('show');
    }

    public function destroy($id)
    {
        $carbook = CarOnRent::find($id);
        $carbook->delete();
        return redirect('show');
    }
}
