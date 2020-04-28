@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 mt-4">
      <div class="card">

        <div class="card-header">
          @if ($trip->trip_active)
            {{ __('Active') }}
          @else
            {{ __('Not active') }}
          @endif
        </div>

        <img class="card-img-top" src="{{ URL::to('/') }}{{ giMegBilde($trip->trip_image) }}" alt="{{ __('Trip Images') }}">

        <div class="card-body card-body-flex">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
          @endif

          <h3 class="margin-b">{{ $trip->start_point }} - {{ $trip->end_point }}</h3>
          <div class="item-container item-container-margin-b">
            <div class="item">
              {{ __('Leaving') }}:<br>
              {{ __('Arriving') }}:
            </div>

            <div class="item item-padding-l">
              <b>@samTimeFormat($trip->start_time) - @samDateFormat($trip->start_date)</b><br>
              <b>@samTimeFormat($trip->end_time) - @samDateFormat($trip->end_date)</b>
            </div>
          </div>

          {{-- Hvis Bruker er eier av turen --}}
          @if (Auth::id() == $trip->driver_id && sizeOf($users) > 0)
            <div class="item-container item-container-margin-b flex-column">
              <div class="">{{ __('Passengers: ') }}</div>
              @foreach ($users as $user)
                <div class="ml-4">
                  {{ $user->firstname . ' ' . $user->lastname }}
                </div>
              @endforeach
            </div>
          @endif

          {{-- Hvis Bruker er passasjer --}}
          @foreach ($users as $user)
            @if (Auth::id() == $user->id)
              <div class="item-container item-container-margin-b flex-column">
                <div class="">{{ __('Driver info: ') }}</div>
                <div class="ml-4">
                  Name:  <b>{{ $chauffeur[0]->firstname . ' ' . $chauffeur[0]->lastname }}</b><br>
                  Phone: <b>number: {{ $chauffeur[0]->phone }}</b><br>
                  Email: <b>{{ $chauffeur[0]->email }}</b><br>
                </div>
              </div>
            @endif
          @endforeach

          <div class="item-container item-container-margin-b">
            {{ __('Car description') }}: <br>
            {{ $trip->car_description }}
          </div>
          <div class="item-container item-container-margin-b">
            {{ __('Trip info') }}: <br>
            {{ $trip->trip_info }}
          </div>

          <div class="item-container">
            <div class="item">
              {{ __('Kids') }}:
              @if ($trip->kids_allowed)
                <img class="item-ok item-margin-l" src="/img/icons/v.svg" alt="ok">
              @else
                <img class="item-ok item-margin-l" src="/img/icons/x.svg" alt="no">
              @endif
            </div>

            <div class="item item-padding-l">
              {{ __('Pets') }}:
              @if ($trip->pets_allowed)
                <img class="item-ok item-margin-l" src="/img/icons/v.svg" alt="ok">
              @else
                <img class="item-ok item-margin-l" src="/img/icons/x.svg" alt="no">
              @endif
            </div>
          </div>
        </div>

        <div class="card-footer">
          {{-- Her må det fikses i stylene!! --}}
          @if($trip->seats_available > 0)
            <div class="form-group row">
              <div class="col-md-4 col-form-label">{{ __('Seats available') }}: </div>
              <div class="col-md-6">
                <div class="col-md-4 form-control form-control-text">
                  {{ $trip->seats_available }}
                </div>
              </div>
            </div>
          @else
            <p style="text-align: center;">{{ __('The trip is full') }}</p>
          @endif

          @auth
            {{-- En bruker kan ikke bli med som passasjer på sin egen tur! --}}
              @if (Auth::id() != $trip->driver_id && $trip->seats_available > 0)
                @foreach ($users as $user)
                  @if (Auth::id() == $user->id)
                    <input type="hidden" name="piss" value={{$piss = 1}}>
                  @endif
                @endforeach

                @if ($piss != 1)
                  @if ($trip->trip_active)
                    <form method="POST" action="{{ route('joinTrip', $trip) }}" id="tripform">
                      @csrf {{-- viktig! ellers så feiler siden --}}
                      {{-- @method('PUT')  Forteller Laravel at jeg ønsker POST å være en PUT. PUT som i 'oppdater'  --}}

                      <input type="hidden" name="passenger_id" value="{{ auth()->user()->id }}">
                      <input type="hidden" name="trip_id" value="{{ $trip->id }}">

                      <div class="form-group row">
                        <label for="seats_available" class="col-md-4 col-form-label">{{ __('Seats requested') }}: </label>
                        <div class="col-md-6">
                          <input id="seats_available" type="number" min="1" max="{{ $trip->seats_available }}"
                            class="form-control @error('seats_available') is-invalid @enderror"
                            name="seats_available" value="{{ old('seats_available', 1) }}"
                            required autocomplete="seats_available"
                            autofocus>
                          @error('seats_requested')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                      </div>

                      <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                          <button type="submit" class="btn btn-primary">{{ __('Join trip') }}</button>
                        </div>
                      </div>
                    </form>
                  @endif
                @endif
              @endif

              {{-- Hvis Bruker er eier av turen --}}
              @if (Auth::id() == $trip->driver_id)
              {{--
                @foreach ($users as $user)
                  <p>{{$user->firstname . ' ' . $user->lastname . ', '}}</p>
                @endforeach
              --}}
                <div class="form-group row mb-0">
                  @if ($trip->trip_active)
                    <form method="POST" onsubmit="return confirm('Do you really want to destroy this trip?');" class="card-center-buttons" action="{{ route('destroyTrip', $trip) }}" id="tripform">
                      @csrf {{-- viktig! ellers så feiler siden --}}
                      <a href="/trips/{{ $trip->id }}/edit" class="btn btn-primary mb-2 mr-2">{{ __('Edit trip') }}</a>
                      <button type="submit" class="btn btn-primary mb-2 mr-2">{{ __('Cancel trip') }}</button>
                    </form>
                  @endif
                </div>
              @endif

              {{-- Hvis Bruker er passasjer --}}
              @foreach ($users as $user)
                @if (Auth::id() == $user->id)
                  <div class="form-group row">
                    <div class="col-md-4 col-form-label">{{ __('Seats requested') }}: </div>
                    <div class="col-md-6">
                      <div class="col-md-4 form-control form-control-text">
                        {{ $user->seats_requested }}
                      </div>
                    </div>
                  </div>

                  {{--
                    <p>
                      {{ __('Driver info: ') }}
                      {{ 'Name: '. $chauffeur[0]->firstname . ' ' . $chauffeur[0]->lastname . ', ' .
                        'Phone number: ' . $chauffeur[0]->phone . ', Email: ' .
                        $chauffeur[0]->email
                      }}
                    </p>
                  --}}

                  {{-- Forlat Tur Knapp --}}
                  @if ($trip->trip_active)
                    <form method="POST" onsubmit="return confirm('Do you really want to leave this trip?');" action="{{ route('destroyPassenger', $trip) }}" id="tripform">
                      @csrf {{-- viktig! ellers så feiler siden --}}
                      <input type="hidden" name="passenger_id" value="{{ auth()->user()->id }}">
                      <input type="hidden" name="trip_id" value="{{ $trip->id }}">
                      <input type="hidden" name="seats_requested" value="{{ $user->seats_requested }}">
                      <button type="submit" class="btn btn-primary">{{ __('Leave trip') }}</button>
                    </form>
                  @endif
                @endif
              @endforeach


            @endauth
          </div>

      </div>
    </div>
  </div>
</div>
@endsection
