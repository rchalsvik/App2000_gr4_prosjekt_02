@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                    <table border=1>
                      <tr>
                        <td>Starting Point</td>
                        <td>Start Date</td>
                        <td>Seats Available</td>
                        <td>Car Description</td>
                      </tr>
                      @foreach ($trips as $trip)
                        <tr>
                          <td>{{ $trip->start_point }}</td>
                          <td>{{ $trip->start_date }}</td>
                          <td>{{ $trip->seats_available }}</td>
                          <td>{{ $trip->car_description }}</td>
                        </tr>
                      @endforeach
                    </table>

                    <div id="new_trip" class="">
                      <a href="{{ route('createTrip') }}">New Trip</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
