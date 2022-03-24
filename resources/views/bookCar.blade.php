{{-- BS CSS --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
{{-- BS JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
{{-- BS Icon CDN --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
{{-- Radio Button CSS --}}
<style>
    body {
        font-family: 'Merriweather', serif;
        font-weight: bolder;
    }

    #halfDayTime {
        padding: 10px;
        display: none;
    }

    #hourlyTime {
        padding: 10px;
        display: none;
    }

</style>

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

<div class="container">
    <div class="content-wrapped col-sm-12 mt-3">
        <div class="text-success text-center">
            {{ session('message') }}
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
                <div class="col-sm-6">
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
                        <input type="radio" name="bookingType" value="Full Day" id="fullDayId" checked> Full Day
                    </label>

                    {{-- halfDay --}}
                    <label>
                        <input type="radio" name="bookingType" value="Half Day" id="halfDayId"> Half Day
                    </label>

                    {{-- hourly --}}
                    <label>
                        <input type="radio" name="bookingType" value="Hourly" id="hourlyId"> Hourly
                    </label>
                    {{-- halfDayDiv --}}
                    <div id="halfDayTime">
                        <select name="halfDay" class="form-control">
                            <option value="" class="form-group" selected disabled>Select Time</option>
                            <option value="09:00am To 01:00pm" class="form-group text-success">09:00am To 01:00pm
                            </option>
                            <option value="02:00pm To 09:00pm" class="form-group text-success">02:00pm To 09:00pm
                            </option>
                        </select>
                    </div>

                    {{-- hourlyDiv --}}
                    <div id="hourlyTime">
                        From: <select name="fromTime" class="form-control">
                            <option value="" class="form-group" selected disabled>Select Time</option>
                            <option value="09:00am To" class="form-group text-primary">09:00am</option>
                            <option value="10:00am To" class="form-group text-primary">10:00am</option>
                            <option value="11:00am To" class="form-group text-primary">11:00am</option>
                            <option value="12:00pm To" class="form-group text-primary">12:00pm</option>
                            <option value="" class="form-group" disabled> > Break Time < </option>
                            <option value="02:00pm To" class="form-group text-primary">02:00pm</option>
                            <option value="03:00pm To" class="form-group text-primary">03:00pm</option>
                            <option value="04:00pm To" class="form-group text-primary">04:00pm</option>
                            <option value="05:00pm To" class="form-group text-primary">05:00pm</option>
                            <option value="06:00pm To" class="form-group text-primary">06:00pm</option>
                            <option value="07:00pm To" class="form-group text-primary">07:00pm</option>
                            <option value="08:00pm To" class="form-group text-primary">08:00pm</option>
                        </select>
                        To: <select name="toTime" class="form-control">
                            <option value="" class="form-group" selected disabled>Select Time</option>
                            <option value="10:00am" class="form-group text-primary">10:00am</option>
                            <option value="11:00am" class="form-group text-primary">11:00am</option>
                            <option value="12:00pm" class="form-group text-primary">12:00pm</option>
                            <option value="" class="form-group" disabled> > Break Time < </option>
                            <option value="02:00pm" class="form-group text-primary">02:00pm</option>
                            <option value="03:00pm" class="form-group text-primary">03:00pm</option>
                            <option value="04:00pm" class="form-group text-primary">04:00pm</option>
                            <option value="05:00pm" class="form-group text-primary">05:00pm</option>
                            <option value="06:00pm" class="form-group text-primary">06:00pm</option>
                            <option value="07:00pm" class="form-group text-primary">07:00pm</option>
                            <option value="08:00pm" class="form-group text-primary">08:00pm</option>
                            <option value="09:00pm" class="form-group text-primary">09:00pm</option>
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

{{-- halfDay JS --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    // showOption
    $(document).ready(function() {
        $("#halfDayId").click(function() {
            $("#halfDayTime").slideDown("fast");
        });
    });
    // hideOption
    $(document).ready(function() {
        $("#fullDayId").click(function() {
            $("#halfDayTime").slideUp("fast")
        });
    });
    $(document).ready(function() {
        $("#hourlyId").click(function() {
            $("#halfDayTime").slideUp("fast")
        });
    });
</script>

{{-- hourly JS --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    // showOption
    $(document).ready(function() {
        $("#hourlyId").click(function() {
            $("#hourlyTime").slideDown("fast");
        });
    });
    // hideOption
    $(document).ready(function() {
        $("#fullDayId").click(function() {
            $("#hourlyTime").slideUp("fast")
        });
    });
    $(document).ready(function() {
        $("#halfDayId").click(function() {
            $("#hourlyTime").slideUp("fast")
        });
    });
</script>
