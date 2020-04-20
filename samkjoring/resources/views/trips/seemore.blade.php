@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  @if ($trip->trip_active)
                    {{ __('Active') }}
                  @else
                    {{ __('Not active') }}
                  @endif
                </div>

                {{-- <img class="card-img-top" src="{{URL::to('/')}}/{{ randomImagesThatWeTotallyOwnFromDirectoryOnMachine() }}" alt=""> --}}

                {{-- <img src="data:image/jpeg;base64,{{ chunk_split(base64_encode($trip->trip_image)) }}" alt="Image"> --}}
                <img class="card-img-top card-img-top-interactive" src="{{ URL::to('/') }}/{{ giMegBilde($trip->trip_image) }}" alt="Trip Images">

                <div class="card-body card-body-flex">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3 class="margin-b">{{ $trip->start_point }} - {{ $trip->end_point }}</h3>
                    <div class="item-container item-container-margin-b">
                      <div class="item">
                        {{ __('Departure') }}:<br>
                        {{ __('Arrival') }}:
                      </div>

                      <div class="item item-padding-l">
                        <b>@samTimeFormat($trip->start_time) - @samDateFormat($trip->start_date)</b><br>
                        <b>@samTimeFormat($trip->end_time) - @samDateFormat($trip->end_date)</b>
                      </div>
                    </div>


                    <div class="item-container item-container-margin-b">
                      {{ __('Car Description') }}: <br>
                      {{ $trip->car_description }}
                    </div>
                    <div class="item-container item-container-margin-b">
                      {{ __('Trip Info') }}: <br>
                      {{ $trip->trip_info }}
                    </div>

                    <div class="item-container">
                      <div class="item">
                        {{ __('Pets') }}:
                        @if ($trip->pets_allowed)
                          <img class="item-ok item-margin-l" src="/img/icons/v.svg" alt="ok">
                        @else
                          <img class="item-ok item-margin-l" src="/img/icons/x.svg" alt="no">
                        @endif
                      </div>
                      <div class="item item-padding-l">
                        {{ __('Children') }}:
                        @if ($trip->kids_allowed)
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
                      <div class="col-md-4 col-form-label">{{ __('Seats Available') }}: </div>
                      <div class="col-md-6">
                        <div class="col-md-4 form-control form-control-text">
                          {{ $trip->seats_available }}
                        </div>
                      </div>
                  </div>
                  @else
                    <p style="text-align: center;">{{ __('Full Trip') }}</p>
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
                                <label for="seats_available" class="col-md-4 col-form-label">{{ __('Seats requested') }}</label>
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
                                <button type="submit" class="btn btn-primary">{{ __('Join Trip') }}</button>
                              </div>
                            </div>

                          </form>
                          @endif
                        @endif
                      @endif

                    @if (Auth::id() == $trip->driver_id)
                      @foreach ($users as $user)
                        <p>{{$user->firstname . ' ' . $user->lastname . ', '}}</p>
                      @endforeach
                      <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                          @if ($trip->trip_active)
                          <form method="POST" onsubmit="return confirm('Do you really want to destroy this trip?');" action="{{ route('destroyTrip', $trip) }}" id="tripform">
                            <a href="/trips/{{ $trip->id }}/edit" class="btn btn-primary mb-2 mr-2">{{ __('Edit Trip') }}</a>
                            {{-- <a href="/trips/{{ $trip->id }}/destroyTrip" class="btn btn-primary">{{ __('Cancel Trip') }}</a> --}}
                            @csrf {{-- viktig! ellers så feiler siden --}}
                            <button type="submit" class="btn btn-primary mb-2 mr-2">{{ __('Cancel Trip') }}</button>
                          </form>
                          @endif
                        </div>
                      </div>
                    @endif

                    @foreach ($users as $user)
                    @if (Auth::id() == $user->id)
                      {{--<p>{{ __('You have already joined this trip') }}</p>--}}
                      <div class="form-group row">
                          <div class="col-md-4 col-form-label">{{ __('Seats requested ') }}</div>
                          <div class="col-md-6">
                            <div class="col-md-4 form-control form-control-text">
                              {{$user->seats_requested}}
                            </div>
                          </div>
                      </div>
                      {{--<p>{{ __('You requested ') }} {{$user->seats_requested}} {{ __(' seat(s)') }}</p>--}}
                      {{--@foreach ($chauffeur as $sjåfør)--}}
                      <p>{{ __('Driver info: ')}} {{'Name: '. $chauffeur[0]->firstname . ' ' . $chauffeur[0]->lastname . ', ' . 'Phone number: ' . $chauffeur[0]->phone . ', Email: ' . $chauffeur[0]->email}}</p>
                      {{--@endforeach--}}

                      @if ($trip->trip_active)
                      <form method="POST" onsubmit="return confirm('Do you really want to leave this trip?');" action="{{ route('destroyPassenger', $trip) }}" id="tripform">
                        @csrf {{-- viktig! ellers så feiler siden --}}
                        <input type="hidden" name="passenger_id" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="trip_id" value="{{ $trip->id }}">
                        <input type="hidden" name="seats_requested" value="{{ $user->seats_requested }}">
                      <button type="submit" class="btn btn-primary">{{ __('Leave Trip') }}</button>
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
