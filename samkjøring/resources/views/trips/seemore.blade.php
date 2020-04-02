@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Show Trip') }} - AuthID: {{ Auth::id() }}, TurEierID: {{ $trip->driver_id }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif



                        <h3>{{ $trip->start_point }} - {{ $trip->end_point }}</h3>
                        <p>{{ __('Starts at') }}: {{ $trip->start_date }}, {{ $trip->start_time }}</p>
                        <p>{{ __('Arrives at') }}: {{ $trip->end_date }}, {{ $trip->end_time }}</p>
                        <p>{{ __('Seats Available') }}: {{ $trip->seats_available }}</p>
                        <p>{{ __('Car Description') }}: {{ $trip->car_description }}</p>
                        <p>{{ __('Trip Info') }}: {{ $trip->trip_info }}</p>
                        <p>{{ __('Pets Allowed') }}?
                          @if ($trip->pets_allowed)
                            &#x1F44D;
                          @else
                            &#x1F44E;
                          @endif
                        </p>
                        <p>{{ __('Kids Allowed') }}?
                          @if ($trip->kids_allowed)
                            &#x1F44D;
                          @else
                            &#x1F44E;
                          @endif
                        </p>


                        {{-- Jeg har ikke sletta det nedentil tilfelle jeg har misforstått. Men sjekk linje 58-63, stemmer det? --}}


                        {{-- Sjekk om det er Bruker som har laget turen --}}
                        {{-- @if (Auth::id() == DB::table('trips')->where('driver_id', $trip->trip_id)->value('driver_id'))
                          <p>HEst er best!</p>
                        @endif
                        <p>{{ Auth::id() . ' - ' . $trip->driver_id}}</p>
                        @if (Auth::id() == $trip->driver_id)
                          <p>Pest er lik Hest.</p>
                        @endif
                        --}}
                        {{--  <div id="join_trip" class="">
                      <a href="/trips/{{  }}/join">{{ __('Join Trip') }}</a> --}}



                    </div>
                </div>
                {{-- En bruker kan ikke bli med som passasjer på sin egen tur! --}}
                @if (Auth::id() != $trip->driver_id && $trip->seats_available > 0)
                  <div class="card-footer">
                    <form method="POST" action="{{ route('joinTrip', $trip) }}" id="tripform">
                      @csrf {{-- viktig! ellers så feiler siden --}}
                      {{-- @method('PUT')  Forteller Laravel at jeg ønsker POST å være en PUT. PUT som i 'oppdater'  --}}

                      <input type="hidden" name="passenger_id" value="{{ auth()->user()->id }}">
                      <input type="hidden" name="trip_id" value="{{ $trip->id }}">

                      <label for="seats_available" class="col-md-4 col-form-label text-md-right">{{ __('Seats requested') }}</label>

                      <div class="col-md-6">
                          <input id="seats_available" type="number" min="1" max="{{ $trip->seats_available }}" class="form-control @error('seats_available') is-invalid @enderror" name="seats_available" value="{{ old('seats_available', 1) }}" required autocomplete="seats_available" autofocus>

                          @error('seats_requested')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>

                      <div class="form-group row mb-0">
                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  {{ __('Join Trip') }}
                              </button>
                          </div>
                      </div>
                  </form>

                    {{-- <a href="/trips/{{ $trip->id }}/seemore" class="btn btn-primary">{{ __('Join Trip') }}</a> --}}
                  </div>
                @endif

                @if (Auth::id() == $trip->driver_id)
                  <div class="card-footer">
                    <a href="/trips/{{ $trip->id }}/edit" class="btn btn-primary">{{ __('Edit Trip') }}</a>
                  </div>
                @endif
            </div>
        </div>
    </div>
</div>


@endsection
