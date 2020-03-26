@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Show Trip') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    @foreach ($trip as $turenDin)

                        <p>{{ $trip->start_point }}</p>
                        <p>{{ $trip->end_point }}</p>
                        <p>{{ $trip->start_date }}</p>
                        <p>{{ $trip->end_date }}</p>
                        <p>{{ $trip->start_time }}</p>
                        <p>{{ $trip->end_time }}</p>
                        <p>{{ $trip->seats_available }}</p>
                        <p>{{ $trip->car_description }}</p>
                        <p>{{ $trip->trip_info }}</p>
                        <p>{{ $trip->kids_allowed }}</p>
                        <p>{{ $trip->pets_allowed }}</p>

                    @endforeach



                    <div id="new_trip" class="">
                      <a href="{{ route('createTrip') }}">New Trip</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
