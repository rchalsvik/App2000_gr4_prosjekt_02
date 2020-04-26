@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-4 mb-4">
            <div class="card">
                <div class="card-header"><h4>{{ __('Search') }}</h4></div>

                <div class="card-body">
                    <form method="GET" action="{{ route('searchShow') }}" id="tripform">
                      @csrf {{-- viktig! ellers så feiler siden --}}

                        <div class="form-group row">
                            <label for="start_point" class="col-md-4 col-form-label text-md-right">{{ __('Search for starting point') }}</label>

                            <div class="col-md-6">
                                <input id="start_point" type="text" class="form-control @error('start_point') is-invalid @enderror" name="start_point" value="{{ old('start_point') }}" placeholder="{{ __('Starting point') }}" autocomplete="start_point" autofocus>

                                @error('start_point')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="start_date" class="col-md-4 col-form-label text-md-right">{{ __('Start date') }}</label>

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
                            <label for="end_point" class="col-md-4 col-form-label text-md-right">{{ __('Search for ending point') }}</label>

                            <div class="col-md-6">
                                <input id="end_point" type="text" class="form-control @error('end_point') is-invalid @enderror" name="end_point" value="{{ old('end_point') }}" placeholder="{{ __('End point') }}" autocomplete="end_point" autofocus>

                                @error('end_point')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="seats_available" class="col-md-4 col-form-label text-md-right">{{ __('Seats available') }}</label>

                            <div class="col-md-6">
                                <input id="seats_available" type="number" min="0" max="45" class="form-control @error('seats_available') is-invalid @enderror" name="seats_available" value="{{ old('seats_available') }}" autocomplete="seats_available" autofocus>

                                @error('seats_available')
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
                                <input id="pets_allowed" type="checkbox" class="btn-group-toggle" name="pets_allowed" value="1" autocomplete="pets_allowed">
                            </div>
                        </div>

                        <div class="form-group row">
                          <label for="kids_allowed" class="col-md-4 col-form-label text-md-right">{{ __('Kids allowed') }}</label>

                          <div class="col-md-6 flex flex align-items-center">
                            <input type="hidden" name="kids_allowed" value="0">
                            <input id="kids_allowed" type="checkbox" class="btn-group-toggle" name="kids_allowed" value="1" autocomplete="kids_allowed">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="trip_active" class="col-md-4 col-form-label text-md-right">{{ __('Active trips only') }}</label>

                          <div class="col-md-6 flex flex align-items-center">
                            <input type="hidden" name="trip_active" value="0">
                            <input id="trip_active" type="checkbox" class="btn-group-toggle" name="trip_active" value="1" autocomplete="trip_active">
                          </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            {{ __('Search') }}
                        </button>
                    </form>

                    {{--<!--
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
                  -->--}}
                </div>
            </div>

            {{--<!--@foreach ($trips as $trip)
              <div class="card mb-4">
                <div class="card-body">
                  <div class="item-container item-c-100 item">
                    <h4  class=""><a href="{{ route('seeMore', $trip->id) }}">{{ $trip->start_point }} - {{ $trip->end_point }} </a></h4>
                    <div class="">
                      @if ($trip->trip_active)
                      {{ __('Active') }}
                      @else
                      {{ __('Not active') }}
                      @endif
                    </div>
                  </div>


                  <p>@samDateTimeFormat($trip->start_date, $trip->start_time) - @samDateTimeFormat($trip->end_date, $trip->end_time)</p>
                  <p style="text-align: right">
                    {{ $trip->seats_available }} {{ __('seats available') }}
                  </p>
                </div>
              </div>
            @endforeach-->--}}

            {{-- Sida begynner her du --}}
            <div class="row text-left">
              @foreach ($trips as $trip)
                <div class="sam-col mb-4">
                  <div class="card mb-1 h-100">
                    <div class="card-body @if(!$trip->trip_active) card-deactive @endif">

                      {{-- Timetabell tekst --}}
                      <div class="item-container flex-jc-sb item-c-100 mb-3">
                        <h3 class="overflow">
                          <a href="{{ route('seeMore', $trip->id) }}">
                            {{ $trip->start_point }} - <br>
                            {{ $trip->end_point }}
                          </a>
                        </h3>
                        <div class="ml-4 font-weight-bolder flex align-items-start    @if($trip->trip_active) text-active @else text-deactive @endif  ">
                          @if ($trip->trip_active)
                            {{ __('Active') }}<img class="ml-2 mt-n-1" src="/img/icons/active.svg" alt="{{ __('Active') }}">
                          @else
                            {{ __('Not Active') }}<img class="ml-2 mt-n-1" src="/img/icons/deactive.svg" alt="{{ __('Not Active') }}">
                          @endif
                        </div>
                      </div>

                      {{-- Timetabell tekst --}}
                      <div class="container sam-container p-0">
                        {{-- Departure --}}
                        <div class="mb-3 mr-4 sam-item flex">
                          <div class="mr-1 flex flex-column">
                            <div class="mb-2 flex flex-jc-r">
                              <img class="mr-3 mt-n-1" src="/img/icons/departure.svg" alt="Departure">
                              <img class="mr-1 mt-n-1" src="/img/icons/date.svg" alt="Date">
                            </div>
                            <div class="mb-2 flex flex-jc-r">
                              <img class="mr-1 mt-n-1" src="/img/icons/time.svg" alt="Time">
                            </div>
                          </div>
                          <div class="font-weight-bold">
                            <div>@samDateShortFormat($trip->start_date) @samYearFormat($trip->start_date)</div>
                            <div>@samTimeFormat($trip->start_time)</div>
                          </div>
                        </div>
                        {{-- Arrival --}}
                        <div class="mb-3 sam-item flex">
                          <div class="mr-1 flex flex-column flex-jc-r">
                            <div class="mb-2 flex flex-jc-r">
                              <img class="mr-3 mt-n-1" src="/img/icons/arrival.svg" alt="Arrival">
                              <img class="mr-1 mt-n-1" src="/img/icons/date.svg" alt="Date">
                            </div>
                            <div class="mb-2 flex flex-jc-r">
                              <img class="mr-1 mt-n-1" src="/img/icons/time.svg" alt="Time">
                            </div>
                          </div>
                          <div class="font-weight-bold">
                            <div>@samDateShortFormat($trip->end_date) @samYearFormat($trip->end_date)</div>
                            <div>@samTimeFormat($trip->end_time)</div>
                          </div>
                        </div>
                      </div>

                      {{-- Seats tilgjengelig --}}
                      <div class="flex flex-jc-r">
                        @if ($trip->trip_active)
                          {{ $trip->seats_available }} {{ __('seats available') }}
                          <img class="ml-2 mb-n-1" src="/img/icons/chair_line.svg" alt="Seat">
                        @else
                          &nbsp;
                        @endif
                      </div>

                    </div>
                  </div>
                </div>
              @endforeach
              </div>

              {{-- Request::except('page') henter alle verdier fra addresslinja som ikke er page=1..2..3 osv --}}
              <div class="paginator-container">
                {{ $trips->appends(Request::except('page'))->links() }}
              </div>

        </div>
    </div>
</div>
@endsection
