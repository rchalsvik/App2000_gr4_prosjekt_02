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

                    <ul>
                      @foreach ($trips as $trip)
                        <li>
                          <p>{{ $trip->car_description }}</p>
                        </li>
                      @endforeach
                    </ul>

                    <div id="new_trip" class="">
                      <a href="{{ route('createTrip') }}">New Trip</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
