@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Edit trip') }}</div>

        <div class="card-body">
          <form method="POST" action="{{ route('updateTrip', $trip) }}" id="tripform" enctype="multipart/form-data">
            @csrf {{-- viktig! ellers så feiler siden --}}
            @method('PUT') {{-- Forteller Laravel at jeg ønsker POST å være en PUT. PUT som i 'oppdater' --}}

            <input type="hidden" name="driver_id" value="{{ auth()->user()->id }}">

            @if ($passCount > 0)
              <input type="hidden" name="start_point" value="{{ $trip->start_point }}">
              <input type="hidden" name="end_point" value="{{ $trip->end_point }}">
              <input type="hidden" name="start_date" value="{{ $trip->start_date }}">
              <input type="hidden" name="start_time" value="{{ date("h:i", strtotime($trip->start_time)) }}">
              <input type="hidden" name="end_time" value="{{ date("h:i", strtotime($trip->end_time)) }}">
              <input type="hidden" name="end_date" value="{{ $trip->end_date }}">
              <input type="hidden" name="kids_allowed" value="{{ $trip->kids_allowed }}">
              <input type="hidden" name="pets_allowed" value="{{ $trip->pets_allowed }}">

              {{ __('You have atleast one passenger and therefore cannot edit certain fields like start/end point and time.') }}

              <div class="form-group row">
                <label for="seats_available" class="col-md-4 col-form-label text-md-right">{{ __('Seats available') }}</label>

                <div class="col-md-6">
                  <input id="seats_available" type="number" min="0" max="45" class="form-control @error('seats_available') is-invalid @enderror" name="seats_available" value="{{ old('seats_available', $trip->seats_available) }}" required autocomplete="seats_available" autofocus>

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
                  <textarea id="car_description" class="form-control @error('car_description') is-invalid @enderror" name="car_description" rows="4" cols="44" form="tripform" maxlength="255" wrap="hard" required autocomplete="car_description" autofocus>{{ old('car_description', $trip->car_description) }}</textarea>

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
                  <textarea id="trip_info" class="form-control @error('trip_info') is-invalid @enderror" name="trip_info" rows="4" cols="44" form="tripform" maxlength="255" wrap="hard" required autocomplete="trip_info" autofocus>{{ old('trip_info', $trip->trip_info) }}</textarea>

                  @error('trip_info')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="trip_image" class="col-md-4 col-form-label text-md-right">{{ __('Image (Optional)') }}</label>

                <div class="col-md-6">
                  <input id="trip_image" type="file" class="form-control @error('trip_image') is-invalid @enderror" name="trip_image" value="{{ old('trip_image, $trip->trip_image') }}" autofocus>

                  @error('trip_image')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

            @else
              <div class="form-group row">
                <label for="start_point" class="col-md-4 col-form-label text-md-right">{{ __('Starting point') }}</label>
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
                <label for="end_point" class="col-md-4 col-form-label text-md-right">{{ __('End point') }}</label>

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
                <label for="start_date" class="col-md-4 col-form-label text-md-right">{{ __('Start date') }}</label>

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
                <label for="start_time" class="col-md-4 col-form-label text-md-right">{{ __('Start time') }}</label>

                <div class="col-md-6">
                  <input id="start_time" type="time" class="form-control @error('start_time') is-invalid @enderror" name="start_time" value="{{ old('start_time', date("H:i", strtotime($trip->start_time))) }}" required autofocus>

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
                  <input id="end_date" type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{ old('end_date', $trip->end_date) }}" required autocomplete="end_date" autofocus>

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
                  <input id="end_time" type="time" class="form-control @error('end_time') is-invalid @enderror" name="end_time" value="{{ old('end_time', date("H:i", strtotime($trip->end_time))) }}" required autocomplete="end_time" autofocus>

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
                  <input id="seats_available" type="number" min="0" max="45" class="form-control @error('seats_available') is-invalid @enderror" name="seats_available" value="{{ old('seats_available', $trip->seats_available) }}" required autocomplete="seats_available" autofocus>

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
                  <textarea id="car_description" class="form-control @error('car_description') is-invalid @enderror" name="car_description" rows="2" cols="44" form="tripform" maxlength="255" wrap="hard" required autocomplete="car_description" autofocus>{{ old('car_description', $trip->car_description) }}</textarea>

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
                  <textarea id="trip_info" class="form-control @error('trip_info') is-invalid @enderror" name="trip_info" rows="4" cols="44" form="tripform" maxlength="255" wrap="hard" required autocomplete="trip_info" autofocus>{{ old('trip_info', $trip->trip_info) }}</textarea>

                  @error('trip_info')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="pets_allowed" class="col-md-4 col-form-label text-md-right">{{ __('Pets allowed') }}</label>

                <div class="col-md-6 flex flex align-items-center">
                  <input type="hidden" name="pets_allowed" value="0">
                  <input id="pets_allowed" type="checkbox" class="btn-group-toggle" name="pets_allowed" value="1" autocomplete="pets_allowed" @if($trip->pets_allowed) checked @endif>
                </div>
              </div>

              <div class="form-group row">
                <label for="kids_allowed" class="col-md-4 col-form-label text-md-right">{{ __('Kids allowed') }}</label>

                <div class="col-md-6 flex flex align-items-center">
                  <input type="hidden" name="kids_allowed" value="0">
                  <input id="kids_allowed" type="checkbox" class="btn-group-toggle" name="kids_allowed" value="1" autocomplete="kids_allowed" @if($trip->kids_allowed) checked @endif>
                </div>
              </div>

              <div class="form-group row">
                <label for="trip_image" class="col-md-4 col-form-label text-md-right">{{ __('Image (Optional)') }}</label>

                <div class="col-md-6">
                  <input id="trip_image" type="file" class="form-control form-control-choose-file @error('trip_image') is-invalid @enderror" name="trip_image" value="{{ old('trip_image, $trip->trip_image') }}" autofocus>

                  @error('trip_image')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

            @endif
            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  {{ __('Update trip') }}
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
