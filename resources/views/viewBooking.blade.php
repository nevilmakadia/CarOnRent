{{-- CSS --}}
<link rel="stylesheet" href={{ asset('css/style.css') }}>
<title>Manage Booking</title>
<div class="card">
    <div class="card-header">
        CarOnRent / <span class="text-primary">viewBooking</span>
    </div>
    <div class="card-body text-center">
        <h5 class="card-title">Book Car On Rent</h5>
        <p class="card-text">Collection Of Branded Cars</p>
        <a href="bookCar" class="btn btn-success text-white"><i class="bi bi-plus-circle"></i> Book Car</a>
        <a href="viewBooking" class="btn btn-primary text-white"><i class="bi bi-card-checklist"></i> View Booking</a>
    </div>
</div>

<div class="p-4">
    <div class="content-wrapped text-center">
        <div class="text-success">
            <b style="text-transform: capitalize">{{ session('message') }}</b>
            <span class="text-danger">
                <b style="text-transform: capitalize">{{ session('message2') }}</b>
            </span>
        </div>
        <table class="table table-bordered mt-3 table-hover table-responsive" style="border: 2px solid black">
            <tr class="text-center align-middle" style="border: 2px solid black">
                <th colspan="11" class="text-center">
                    <span class="text-secondary">Car</span>
                    <span class="text-success">On</span>
                    <span class="text-primary">Rent</span>
                    <span class="text-danger">-</span>
                    <span class="text-primary">Booking</span>
                    <span class="text-danger">Table</span>
                </th>
            </tr>
            <tr class="text-center align-middle" style="border: 2px solid black">
                <td class="text-secondary">Id</td>
                <td class="text-success">City Name</td>
                <td class="text-primary">Car Name</td>
                <td class="text-danger">Booking Date</td>
                <td class="text-primary"
                    title="bookingType 0 = Full Day, bookingType 1 = Half Day, bookingType 2 = Hourly">Booking Type</td>
                <td class="text-danger">Half Day</td>
                <td class="text-success">Hourly</td>
                <td class="text-secondary">Destination</td>
                <td class="text-success">Booked On</td>
                <td class="text-danger">Action</td>
            </tr>
            @foreach ($carArray as $carList)
                <tr class="text-center align-middle" style="border: 2px solid black">
                    <td class="text-secondary">{{ $carList->id }}</td>
                    <td class="text-success">{{ $carList->cityName }}</td>
                    <td class="text-primary">{{ $carList->carName }}</td>
                    <td class="text-danger">{{ $carList->bookingDate }}</td>
                    <td class="text-primary">{{ $carList->bookingType }}</td>
                    <td class="text-danger">{{ $carList->halfDay }}</td>
                    <td class="text-success">{{ $carList->hourly }}</td>
                    <td class="text-secondary">{{ $carList->destination }}</td>
                    <td class="text-success">{{ $carList->created_at }}</td>
                    <td class="text-danger">
                        <a href="deleteBooking/{{ $carList->id }}" class="btn btn-danger"><i
                                class="bi bi-trash"></i> Delete</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>

{{-- JS --}}
{{-- BootStrap --}}
<script src="{{ URL::asset('js/bootstrap.js') }}"></script>
