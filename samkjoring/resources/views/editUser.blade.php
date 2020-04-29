{{-- Laget og endret av Grp04 --}}

@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ __('Edit user info') }}</div>

          <div class="card-body">
            <form method="POST" action="{{ route('updateUser', $user) }}" id="tripform">
              @csrf {{-- viktig! ellers så feiler siden --}}
              @method('PUT') {{-- Forteller Laravel at jeg ønsker POST å være en PUT. PUT som i 'oppdater' --}}

              <input type="hidden" name="id" value="{{ auth()->user()->id }}">
              <input type="hidden" name="firstname" value="{{ auth()->user()->firstname }}">
              <input type="hidden" name="lastname" value="{{ auth()->user()->lastname }}">
              <input type="hidden" name="date_of_birth" value="{{ auth()->user()->date_of_birth }}">
              <input type="hidden" name="email" value="{{ auth()->user()->email }}">
              <input type="hidden" name="password" value="{{ auth()->user()->password }}">

              <div class="form-group row">
                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>
                <div class="col-md-6">
                  <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $user->phone) }}" required autocomplete="phone" autofocus>

                  @error('phone')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                <div class="col-md-6">
                  <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address', $user->address) }}" required autocomplete="address" autofocus>

                  @error('address')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="zipcode" class="col-md-4 col-form-label text-md-right">{{ __('Zipcode') }}</label>
                <div class="col-md-6">
                  <input id="zipcode" type="text" class="form-control @error('zipcode') is-invalid @enderror" name="zipcode" value="{{ old('zipcode', $user->zipcode) }}" required autocomplete="zipcode" autofocus>

                  @error('zipcode')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="hasLicense" class="col-md-4 col-form-label text-md-right">{{ __('Drivers license') }}</label>
                <div class="col-md-6">
                  <input type="hidden" name="hasLicense" value="0">
                  <input id="hasLicense" type="checkbox"
                    class="form-control"
                    name="hasLicense" value="1" autocomplete="hasLicense"
                    @if($user->hasLicense) checked @endif>
                </div>
              </div>

              {{-- Submit --}}
              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    {{ __('Save') }}
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
