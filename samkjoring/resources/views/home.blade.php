@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-4">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{--{{ __('You are logged in!') }}--}}

                    <div class="">
                      <a href="{{ route('editUser', $user) }}">{{ __('Edit user info') }}</a>
                      <a href="{{ route('myTrips') }}">{{ __('My trips') }}</a>
                      <a href="{{ route('myJoinedTrips') }}">{{ __('Joined trips') }}</a>
                    </div>

                    @foreach ($trips as $trip)
                    <div class="">
                      <a href="/trips/{{ $trip->id }}/seemore" class="card-title-link">
                        <h4>{{ __('StartingPoint') }} - {{ __('EndPoint') }}</h4>
                      </a>
                      <p>
                        {{ __('Departure') }}: <b>@samTimeFormat($trip->start_time)</b>
                        <b>@samDateFormat($trip->start_date)</b><b>@samYearFormat($trip->start_date)</b><br>
                        {{ __('Arrival') }}: <b>@samTimeFormat($trip->end_time)</b>
                        <b>@samDateFormat($trip->end_date)</b><b>@samYearFormat($trip->end_date)</b>
                      </p>
                    </div>
                    @endforeach

                    <table border=1>
                      <tr>
                        <td>{{ __('Starting point') }}</td>
                        <td>{{ __('Start date') }}</td>
                        <td>{{ __('Seats available') }}</td>
                        <td>{{ __('Car description') }}</td>
                      </tr>
                      @foreach ($trips as $trip)
                        <tr>
                          <td><h3><a href="{{ route('seeMore', $trip->id) }}">{{ $trip->start_point }}</a></h3></td>
                          <td>@samDateFormat($trip->start_date)</td>
                          <td>{{ $trip->seats_available }}</td>
                          <td>{{ $trip->car_description }}</td>
                        </tr>
                      @endforeach
                    </table>

                    @if (auth()->user()->hasLicense)
                    <div id="new_trip" class="">
                      <a href="{{ route('createTrip') }}">{{ __('New trip') }}</a>
                    </div>
                    @endif

                    {{-- <form method="POST" action="{{ route('editUser', $user) }}" id="userform">
                      @csrf
                      @method('PUT')

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn">
                                {{ __('Edit user info') }}
                            </button>
                        </div>
                    </div>
                </form> --}}

                    <div id="edit_user" class="">
                      <a href="{{ route('editUser', $user) }}">{{ __('Edit user info') }}</a>
                    </div>

                    @if (auth()->user()->hasLicense)
                    <div id="my_trips" class="">
                      <a href="{{ route('myTrips') }}">{{ __('My trips') }}</a>
                    </div>
                    @endif

                    <div id="my_joined_trips" class="">
                      <a href="{{ route('myJoinedTrips') }}">{{ __('Joined trips') }}</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
