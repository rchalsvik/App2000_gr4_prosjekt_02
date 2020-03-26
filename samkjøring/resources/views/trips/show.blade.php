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



                        <h3>{{ $trip->start_point }} - {{ $trip->end_point }}</h3>
                        <p>{{ __('Start date') }}: {{ $trip->start_date }}, {{ $trip->start_time }}</p>
                        <p>{{ __('End time') }}: {{ $trip->end_date }}, {{ $trip->end_time }}</p>
                        <p>{{ __('Seats Available') }}: {{ $trip->seats_available }}</p>
                        <p>{{ __('Car description') }}: {{ $trip->car_description }}</p>
                        <p>{{ __('Trip info') }}: {{ $trip->trip_info }}</p>
                        <p>{{ __('Kids allowed') }}? {{ $trip->kids_allowed }}</p>
                        <p>{{ __('Pets allowed') }}? {{ $trip->pets_allowed }}</p>





                    <div id="new_trip" class="">
                      <a href="{{ route('createTrip') }}">New Trip</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
