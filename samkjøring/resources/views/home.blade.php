@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <table border=1>
                      <tr>
                        <td>{{ __('StartingPoint') }}</td>
                        <td>{{ __('Start Date') }}</td>
                        <td>{{ __('Seats Available') }}</td>
                        <td>{{ __('Car Description') }}</td>
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
                    <div id="new_trip" class="">
                      <a href="{{ route('createTrip') }}">{{ __('New Trip') }}</a>
                    </div>
                    {{-- <form method="POST" action="{{ route('editUser', $user) }}" id="userform">
                      @csrf
                      @method('PUT')

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Edit user info') }}
                            </button>
                        </div>
                    </div>
                </form> --}}

                    <div id="edit_user" class="">
                      <a href="{{ route('editUser', $user) }}">{{ __('Edit userinfo') }}</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
