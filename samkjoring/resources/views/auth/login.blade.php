{{-- Endret av Grp04 --}}
{{-- Denne filen ble generert av Laravel --}}

@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 mt-4">
        <div class="card">
          <div class="card-header">{{ __('Login') }}</div>
          <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
              @csrf {{-- viktig! ellers så feiler siden --}}
              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">
                  {{ __('E-mail address') }}
                </label>
                <div class="col-md-6">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                  {{-- Hvis valideringen i Kontrolleren feiler
                       blir vi kastet tilbake her med melding --}}
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">
                  {{ __('Password') }}
                </label>
                <div class="col-md-6">
                  <input id="password" type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">

                  {{-- Hvis valideringen i Kontrolleren feiler
                       blir vi kastet tilbake her med melding --}}
                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox"
                      name="remember" id="remember"
                      {{-- Om checkboxen skal hukes --}}
                      {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                      {{ __('Remember me') }}
                    </label>
                  </div>
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary mr-4">
                    {{ __('Login') }}
                  </button>

                  {{-- Glemt Passord --}}
                  @if (Route::has('password.request'))
                    <a class="btn-link list-inline-item mt-2"
                      href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                  @endif
                </div>
                <div class="col-md-8 offset-md-4 mt-2">
                  <a class="btn-link" href="{{ route('register') }}">
                      {{ __('New here? Click here to register!') }}
                  </a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
