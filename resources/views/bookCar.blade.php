{{-- CSS --}}
<link rel="stylesheet" href={{ asset('css/style.css') }}>
<title>Book Your Car</title>
<div class="card">
    <div class="card-header">
        CarOnRent / <span class="text-success">bookCar</span>
    </div>
    <div class="card-body text-center">
        <h5 class="card-title">Book Car On Rent</h5>
        <p class="card-text">Collection Of Branded Cars</p>
        <a href="bookCar" class="btn btn-success text-white"><i class="bi bi-plus-circle"></i> Book Car</a>
        <a href="viewBooking" class="btn btn-primary text-white"><i class="bi bi-card-checklist"></i> View Booking</a>
    </div>
</div>

{{-- main section --}}
<div class="container">
    <div class="content-wrapped col-sm-12 mt-3">
        <div class="text-danger text-center">
            <b style="text-transform: capitalize">{{ session('message') }}</b>
        </div>
        <form method="POST" action="submitBooking" id="bookingForm">
            {{ csrf_field() }}
            <div class="row mb-2">

                {{-- cityName --}}
                <div class="col-sm-6">
                    <label class="form-label">Select City:<span class="text-danger"> *</span></label>
                    <select name="cityName" class="form-control">
                        <option value="" class="form-group" disabled selected>Select City</option>
                        <option value="Rajkot" class="form-group text-primary">Rajkot</option>
                        <option value="Morbi" class="form-group text-secondary">Morbi</option>
                        <option value="Ahmedabad" class="form-group text-success">Ahmedabad</option>
                        <option value="Kutch" class="form-group text-danger">Kutch</option>
                        <option value="Surat" class="form-group text-warning">Surat</option>
                        <option value="Vadodara" class="form-group">Vadodara</option>
                    </select>
                    <span class="text-danger">
                        @error('cityName')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                {{-- carName --}}
                <div class="col-sm-6">
                    <label class="form-label">Select Car:<span class="text-danger"> *</span></label>
                    <select name="carName" class="form-control">
                        <option value="" class="form-group" disabled selected>Select Car</option>
                        <option value="Hyundai Verna" class="form-group text-primary">Hyundai Verna</option>
                        <option value="Suzuki Ciaz" class="form-group text-secondary">Suzuki Ciaz</option>
                        <option value="Mahindra Thar" class="form-group text-success">Mahindra Thar</option>
                        <option value="Honda City" class="form-group text-danger">Honda City</option>
                        <option value="Toyota Fortuner" class="form-group text-warning">Toyota Fortuner</option>
                        <option value="Kia Carnival" class="form-group">Kia Carnival</option>
                    </select>
                    <span class="text-danger">
                        @error('carName')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
            </div>
            <div class="row mb-2">

                {{-- bookingDate --}}
                <div class="col-sm-6" id='datetimepicker'>
                    <label class="form-label">Select Journey Date:<span class="text-danger"> *</span></label>
                    <input type="date" name="bookingDate" class="form-control">
                    <span class="text-danger">
                        @error('bookingDate')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                {{-- destination --}}
                <div class="col-sm-6">
                    <label class="form-label">Enter Destination:<span class="text-danger"> *</span></label>
                    <input type="text" name="destination" class="form-control" placeholder="Enter Destination">
                    <span class="text-danger">
                        @error('destination')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
            </div>

            <div class="row mb-2">
                {{-- bookingType --}}
                <div class="col-sm-6">
                    <label class="form-label">Select Journey type:<span class="text-danger">
                            *</span></label><br />
                    {{-- fullDay --}}
                    <label>
                        <input type="radio" name="bookingType" value="0" id="fullDayId" checked> Full Day
                    </label>

                    {{-- halfDay --}}
                    <label>
                        <input type="radio" name="bookingType" value="1" id="halfDayId"> Half Day
                    </label>

                    {{-- hourly --}}
                    <label>
                        <input type="radio" name="bookingType" value="2" id="hourlyId"> Hourly
                    </label>

                    {{-- halfDayDiv --}}
                    <div id="halfDayTime">
                        <select name="halfDay" class="form-control">
                            <option value="" class="form-group" selected disabled>Select Time</option>
                            <option value="09-13" class="form-group text-success">09:00 To 13:00
                            </option>
                            <option value="14-21" class="form-group text-success">14:00 To 21:00
                            </option>
                        </select>
                    </div>

                    {{-- hourlyDiv --}}
                    <div id="hourlyTime">
                        From: <select name="fromTime" class="form-control">
                            <option value="" class="form-group" selected disabled>Select Time</option>
                            <option value="09" class="form-group text-primary">09:00</option>
                            <option value="10" class="form-group text-primary">10:00</option>
                            <option value="11" class="form-group text-primary">11:00</option>
                            <option value="12" class="form-group text-primary">12:00</option>
                            <option value="14" class="form-group text-primary">14:00</option>
                            <option value="15" class="form-group text-primary">15:00</option>
                            <option value="16" class="form-group text-primary">16:00</option>
                            <option value="17" class="form-group text-primary">17:00</option>
                            <option value="18" class="form-group text-primary">18:00</option>
                            <option value="19" class="form-group text-primary">19:00</option>
                            <option value="20" class="form-group text-primary">20:00</option>
                        </select>
                        To: <select name="toTime" class="form-control">
                            <option value="" class="form-group" selected disabled>Select Time</option>
                            <option value="10" class="form-group text-primary">10:00</option>
                            <option value="11" class="form-group text-primary">11:00</option>
                            <option value="12" class="form-group text-primary">12:00</option>
                            <option value="13" class="form-group text-primary">13:00</option>
                            <option value="15" class="form-group text-primary">15:00</option>
                            <option value="16" class="form-group text-primary">16:00</option>
                            <option value="17" class="form-group text-primary">17:00</option>
                            <option value="18" class="form-group text-primary">18:00</option>
                            <option value="19" class="form-group text-primary">19:00</option>
                            <option value="20" class="form-group text-primary">20:00</option>
                            <option value="21" class="form-group text-primary">21:00</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-1 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>

{{-- JS --}}
{{-- RadioButton --}}
<script src="{{ URL::asset('js/RadioButton.js') }}"></script>
{{-- BootStrap --}}
<script src="{{ URL::asset('js/bootstrap.js') }}"></script>
