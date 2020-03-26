@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Trip') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('storeTrip') }}" id="tripform">
                        @csrf

                        <input type="hidden" name="driver_id" value="{{ auth()->user()->id }}">

                        <div class="form-group row">
                            <label for="start_point" class="col-md-4 col-form-label text-md-right">{{ __('Start Point') }}</label>

                            <div class="col-md-6">
                                <input id="start_point" type="text" class="form-control @error('start_point') is-invalid @enderror" name="start_point" value="{{ old('start_point', $trip->start_point) }}" required autocomplete="start_point" autofocus>

                                @error('start_point')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="end_point" class="col-md-4 col-form-label text-md-right">{{ __('End Point') }}</label>

                            <div class="col-md-6">
                                <input id="end_point" type="text" class="form-control @error('end_point') is-invalid @enderror" name="end_point" value="{{ old('end_point', $trip->end_point) }}" required autocomplete="end_point" autofocus>

                                @error('end_point')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="start_date" class="col-md-4 col-form-label text-md-right">{{ __('Start Date') }}</label>

                            <div class="col-md-6">
                                <input id="start_date" type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ old('start_date', $trip->start_date) }}" required autocomplete="start_date" autofocus>

                                @error('start_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="start_time" class="col-md-4 col-form-label text-md-right">{{ __('Start Time') }}</label>

                            <div class="col-md-6">
                                <input id="start_time" type="time" class="form-control @error('start_time') is-invalid @enderror" name="start_time" value="{{ old('start_time', $trip->start_time) }}" required autocomplete="start_time" autofocus>

                                @error('start_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="end_date" class="col-md-4 col-form-label text-md-right">{{ __('End Date') }}</label>

                            <div class="col-md-6">
                                <input id="end_date" type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{ old('end_date', $trip->end_date) }}" required autocomplete="end_date" autofocus>

                                @error('end_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="end_time" class="col-md-4 col-form-label text-md-right">{{ __('End Time') }}</label>

                            <div class="col-md-6">
                                <input id="end_time" type="time" class="form-control @error('end_time') is-invalid @enderror" name="end_time" value="{{ old('end_time', $trip->end_time) }}" required autocomplete="end_time" autofocus>

                                @error('end_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="seats_available" class="col-md-4 col-form-label text-md-right">{{ __('Seats Available') }}</label>

                            <div class="col-md-6">
                                <input id="seats_available" type="number" min="1" max="45" class="form-control @error('seats_available') is-invalid @enderror" name="seats_available" value="{{ old('seats_available', $trip->seats_available) }}" required autocomplete="seats_available" autofocus>

                                @error('seats_available')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="car_description" class="col-md-4 col-form-label text-md-right">{{ __('Car Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="car_description" class="form-control @error('car_description') is-invalid @enderror" name="car_description" rows="8" cols="44" form="tripform" maxlength="255" wrap="hard" required autocomplete="car_description" autofocus value="{{ old('car_description', $trip->car_description) }}"></textarea>

                                @error('car_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="trip_info" class="col-md-4 col-form-label text-md-right">{{ __('Trip Info') }}</label>

                            <div class="col-md-6">
                                <textarea id="trip_info" class="form-control @error('trip_info') is-invalid @enderror" name="trip_info" rows="8" cols="44" form="tripform" maxlength="255" wrap="hard" required autocomplete="trip_info" autofocus value="{{ old('trip_info', $trip->trip_info) }}"></textarea>

                                @error('trip_info')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pets_allowed" class="col-md-4 col-form-label text-md-right">{{ __('Pets Allowed') }}</label>

                            <div class="col-md-6">
                                <input type="hidden" name="pets_allowed" value="0">
                                <input id="pets_allowed" type="checkbox" class="form-control" name="pets_allowed" value="1" autocomplete="pets_allowed" {{ @if ($trip->pets_allowed) checked @endif }}>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kids_allowed" class="col-md-4 col-form-label text-md-right">{{ __('Kids Allowed') }}</label>

                            <div class="col-md-6">
                                <input type="hidden" name="kids_allowed" value="0">
                                <input id="kids_allowed" type="checkbox" class="form-control" name="kids_allowed" value="1" autocomplete="kids_allowed" {{ @if ($trip->kids_allowed) checked @endif }}>
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create Trip') }}
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
