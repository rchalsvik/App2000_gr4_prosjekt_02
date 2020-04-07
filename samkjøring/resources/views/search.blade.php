@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h4><div class="card-header">{{ __('Search') }}</div></h4>

                <div class="card-body">
                    <form method="GET" action="{{ route('searchShow') }}" id="tripform">
                      @csrf {{-- viktig! ellers så feiler siden --}}

                        <div class="form-group row">
                            {{-- <label for="start_point" class="col-md-4 col-form-label text-md-right">{{ __('Find trip') }}</label> --}}

                            <div class="col-md-6">
                                <input id="start_point" type="text" class="form-control @error('start_point') is-invalid @enderror" name="start_point" value="{{ old('start_point') }}" placeholder="Search for a starting point" required autocomplete="start_point" autofocus>

                                @error('start_point')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                                <button type="submit" class="btn btn-primary">
                                    {{ __('Search') }}
                                </button>
                    </form>

                    <table border=1>
                      <tr>
                        <td>{{ __('StartingPoint') }}</td>
                        <td>{{ __('Start Date') }}</td>
                        <td>{{ __('Seats Available') }}</td>
                        <td>{{ __('Car Description') }}</td>
                      </tr>
                      @foreach ($trips as $trip)
                        <tr>
                          <td><h3><a href="{{ route('showTrip', $trip->id) }}">{{ $trip->start_point }}</a></h3></td>
                          <td>{{ $trip->start_date }}</td>
                          <td>{{ $trip->seats_available }}</td>
                          <td>{{ $trip->car_description }}</td>
                        </tr>
                      @endforeach
                    </table>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
