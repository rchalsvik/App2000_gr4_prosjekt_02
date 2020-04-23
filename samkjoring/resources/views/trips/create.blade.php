@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create a trip') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('storeTrip') }}" id="tripform" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="driver_id" value="{{ auth()->user()->id }}">

                        <div class="form-group row">
                            <label for="start_point" class="col-md-4 col-form-label text-md-right">{{ __('Starting point') }}</label>

                            <div class="col-md-6">
                                <input id="start_point" type="text" class="form-control @error('start_point') is-invalid @enderror" name="start_point" value="{{ old('start_point') }}" required autocomplete="start_point" autofocus>

                                @error('start_point')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="end_point" class="col-md-4 col-form-label text-md-right">{{ __('End point') }}</label>

                            <div class="col-md-6">
                                <input id="end_point" type="text" class="form-control @error('end_point') is-invalid @enderror" name="end_point" value="{{ old('end_point') }}" required autocomplete="end_point" autofocus>

                                @error('end_point')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="start_date" class="col-md-4 col-form-label text-md-right">{{ __('Start date') }}</label>

                            <div class="col-md-6">
                                <input id="start_date" type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ old('start_date', date("Y-m-d")) }}" required autocomplete="start_date" autofocus>

                                @error('start_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="start_time" class="col-md-4 col-form-label text-md-right">{{ __('Start time') }}</label>

                            <div class="col-md-6">
                                <input id="start_time" type="time" class="form-control @error('start_time') is-invalid @enderror" name="start_time" value="{{ old('start_time', date("H:i")) }}" required autocomplete="start_time" autofocus>

                                @error('start_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="end_date" class="col-md-4 col-form-label text-md-right">{{ __('End date') }}</label>

                            <div class="col-md-6">
                                <input id="end_date" type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{ old('end_date', date("Y-m-d")) }}" required autocomplete="end_date" autofocus>

                                @error('end_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="end_time" class="col-md-4 col-form-label text-md-right">{{ __('End time') }}</label>

                            <div class="col-md-6">
                                <input id="end_time" type="time" class="form-control @error('end_time') is-invalid @enderror" name="end_time" value="{{ old('end_time', date("H:i")) }}" required autocomplete="end_time" autofocus>

                                @error('end_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="seats_available" class="col-md-4 col-form-label text-md-right">{{ __('Seats available') }}</label>

                            <div class="col-md-6">
                                <input id="seats_available" type="number" min="1" max="45" class="form-control @error('seats_available') is-invalid @enderror" name="seats_available" value="{{ old('seats_available', 1) }}" required autocomplete="seats_available" autofocus>

                                @error('seats_available')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="car_description" class="col-md-4 col-form-label text-md-right">{{ __('Car description') }}</label>

                            <div class="col-md-6">
                                <textarea id="car_description" class="form-control @error('car_description') is-invalid @enderror" name="car_description" rows="8" cols="44" form="tripform" maxlength="255" wrap="hard" required autocomplete="car_description" autofocus>{{ old('car_description') }}</textarea>

                                @error('car_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="trip_info" class="col-md-4 col-form-label text-md-right">{{ __('Trip info') }}</label>

                            <div class="col-md-6">
                                <textarea id="trip_info" class="form-control @error('trip_info') is-invalid @enderror" name="trip_info" rows="8" cols="44" form="tripform" maxlength="255" wrap="hard" required autocomplete="trip_info" autofocus>{{ old('trip_info') }}</textarea>

                                @error('trip_info')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pets_allowed" class="col-md-4 col-form-label text-md-right">{{ __('Pets allowed') }}</label>

                            <div class="col-md-6">
                                <input type="hidden" name="pets_allowed" value="0">
                                <input id="pets_allowed" type="checkbox" class="form-control" name="pets_allowed" value="{{ old('pets_allowed', 1) }}" autocomplete="pets_allowed">
                            </div>
                        </div>

                        <div class="form-group row">
                          <label for="kids_allowed" class="col-md-4 col-form-label text-md-right">{{ __('Kids allowed') }}</label>

                          <div class="col-md-6">
                            <input type="hidden" name="kids_allowed" value="0">
                            <input id="kids_allowed" type="checkbox" class="form-control" name="kids_allowed" value="{{ old('kids_allowed', 1) }}" autocomplete="kids_allowed">
                          </div>
                        </div>


                        <div class="form-group row">
                            <label for="trip_image" class="col-md-4 col-form-label text-md-right">{{ __('Image (Optional)') }}</label>

                            <div class="col-md-6">
                                <input id="trip_image" type="file" class="@error('trip_image') is-invalid @enderror" name="trip_image" value="{{ old('trip_image') }}" autofocus>

                                @error('trip_image')
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>





                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create trip') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
