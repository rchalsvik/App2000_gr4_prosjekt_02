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
                                <input id="start_point" type="text" class="form-control @error('start_point') is-invalid @enderror" name="start_point" value="{{ old('start_point') }}" placeholder="Search for a starting point" autocomplete="start_point" autofocus>

                                @error('start_point')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="start_date" class="col-md-4 col-form-label text-md-right">{{ __('Start Date') }}</label>

                            <div class="col-md-6">
                                <input id="start_date" type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ old('start_date') }}" autocomplete="start_date" autofocus>

                                @error('start_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {{-- <label for="end_point" class="col-md-4 col-form-label text-md-right">{{ __('Find trip') }}</label> --}}

                            <div class="col-md-6">
                                <input id="end_point" type="text" class="form-control @error('end_point') is-invalid @enderror" name="end_point" value="{{ old('end_point') }}" placeholder="Search for an end point" autocomplete="end_point" autofocus>

                                @error('end_point')
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
                          <td><h3><a href="{{ route('seeMore', $trip->id) }}">{{ $trip->start_point }}</a></h3></td>
                          <td>@samDateTimeFormat($trip->start_date, $trip->start_time)</td>
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
