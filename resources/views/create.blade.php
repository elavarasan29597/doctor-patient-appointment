@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-11">
        <h2>Appointment</h2>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


@if (session('success'))
<div class="col-sm-12">
    <div class="alert  alert-success alert-dismissible" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif


@if (session('error'))
<div class="col-sm-12">
    <div class="alert  alert-danger alert-dismissible" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif

<div class="row">
    <div class="">

        <form action="{{ route('doctors.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Doctor Name:</label>
                <select class="form-control" name="doctor" id="doctors">
                    <option value="">Please Select Doctor</option>
                    @foreach ($doctors as $doctor)
                    <option value="{{ $doctor->id }}" {{ old('doctor') == $doctor->id ? "selected" :""}}>{{ $doctor->name }}</option>
                    @endforeach

                </select>
            </div>
            <div class="form-group">
                <label for="email">Patient Name :</label>
                <select class="form-control" name="patient" id="patient_id">
                    <option value="">Please Select Patient</option>
                    @foreach ($patients as $patient)
                    <option {{ old('patient') == $patient->id ? "selected" :""}} value="{{ $patient->id }}">{{ $patient->name }}</option>
                    @endforeach

                </select>
            </div>
            <div class="form-group">
                <label for="phone">Start Date and Time (Ex :2020-11-12 10:20) </label>
                <input type="text" class="form-control" id="start_date_time" placeholder="2020-11-12 10:20" value="{{ old('start_date_time') }}" name="start_date_time">
            </div>

            <div class="form-group">
                <label for="address">End Date and Time (Ex :2020-11-12 10:20)</label>
                <input type="text" class="form-control" id="end_date_time" placeholder="2020-11-14 10:20" value="{{ old('end_date_time') }}" name="end_date_time">
            </div>


            <br>
            <br>
            <button type="submit" class="btn btn-default">Submit</button>
            <br>
            <br>
            <br>

        </form>
    </div>
</div>


@endsection
