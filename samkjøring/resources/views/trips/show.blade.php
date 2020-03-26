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
                        <p>{{ __('Starts at') }}: {{ $trip->start_date }}, {{ $trip->start_time }}</p>
                        <p>{{ __('Arrives at') }}: {{ $trip->end_date }}, {{ $trip->end_time }}</p>
                        <p>{{ __('Seats Available') }}: {{ $trip->seats_available }}</p>
                        <p>{{ __('Car description') }}: {{ $trip->car_description }}</p>
                        <p>{{ __('Trip info') }}: {{ $trip->trip_info }}</p>
                        <p>{{ __('Kids allowed') }}?
                          @if ($trip->kids_allowed)
                            Yes
                          @else
                            No
                          @endif
                        </p>
                        <p>{{ __('Pets allowed') }}?
                          @if ($trip->pets_allowed)
                            Yes
                          @else
                            No
                          @endif
                        </p>


                      {{-- @if ($trip->kids_allowed) ? 'Yes' : 'No' @endif --}}


                    <div id="new_trip" class="">
                      <a href="{{ route('createTrip') }}">New Trip</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
