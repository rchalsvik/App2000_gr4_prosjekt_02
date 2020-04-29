{{-- Endret av Grp04 --}}

@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 mt-4">
      <div class="card mb-4">
        <div class="card-header"><h4>{{ __('Search') }}</h4></div>

        <div class="card-body">
          <form method="GET" action="{{ route('searchShow') }}" id="tripform">
            @csrf {{-- viktig! ellers så feiler siden --}}

            <div class="form-group row">
              <label for="start_point" class="col-md-4 col-form-label text-md-right">{{ __('Search for starting point') }}</label>
              <div class="col-md-6">
                <input id="start_point" type="text"
                  class="form-control @error('start_point') is-invalid @enderror"
                  name="start_point"
                  value="@if(isset($_GET['start_point'])){{ $_GET['start_point'] }}@else{{ $_SESSION['start_point'] = false }}@endif"
                  placeholder="{{ __('Starting point') }}" autocomplete="start_point" autofocus>

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
                  <input id="start_date" type="date"
                  class="form-control @error('start_date') is-invalid @enderror"
                  name="start_date"
                  value="@if(isset($_GET['start_date'])){{ $_GET['start_date'] }}@else{{ $_SESSION['start_date'] = false }}@endif"
                  autocomplete="start_date" autofocus>

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
                  <input id="end_point" type="text"
                  class="form-control @error('end_point') is-invalid @enderror"
                  name="end_point"
                  value="@if(isset($_GET['end_point'])){{ $_GET['end_point'] }}@else{{ $_SESSION['end_point'] = false }}@endif"
                  placeholder="{{ __('End point') }}" autocomplete="end_point" autofocus>

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
                  <input id="seats_available" type="number" min="0" max="45"
                  class="form-control @error('seats_available') is-invalid @enderror"
                  name="seats_available"
                  value="@if(isset($_GET['seats_available'])){{ $_GET['seats_available'] }}@else{{ $_SESSION['seats_available'] = false . 1 }}@endif"
                  autocomplete="seats_available" autofocus>

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
                  <input type="hidden" name="pets_allowed"
                    value="0">
                  <input id="pets_allowed" type="checkbox"
                    class="btn-group-toggle" name="pets_allowed"
                    value="1" autocomplete="pets_allowed"
                    @if(isset($_GET['pets_allowed']))
                      @if($_GET['pets_allowed'] > 0) input checked @endif
                    @endif>
                </div>
              </div>

              <div class="form-group row">
                <label for="kids_allowed" class="col-md-4 col-form-label text-md-right">{{ __('Kids allowed') }}</label>
                <div class="col-md-6 flex flex align-items-center">
                  <input type="hidden" name="kids_allowed" value="0">
                  <input id="kids_allowed" type="checkbox"
                    class="btn-group-toggle" name="kids_allowed"
                    value="1" autocomplete="kids_allowed"
                    @if(isset($_GET['kids_allowed']))
                      @if($_GET['kids_allowed'] > 0) input checked @endif
                    @endif>
                </div>
              </div>

              <div class="form-group row">
                <label for="trip_active" class="col-md-4 col-form-label text-md-right">{{ __('Active trips only') }}</label>
                <div class="col-md-6 flex flex align-items-center">
                  <input type="hidden" name="trip_active" value="0">
                  <input id="trip_active" type="checkbox"
                    class="btn-group-toggle" name="trip_active"
                    value="1" autocomplete="trip_active"
                    @if(isset($_GET['trip_active']))
                      @if($_GET['trip_active'] > 0) input checked @endif
                    @endif>
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="card-center-buttons">
                  <button type="submit" class="btn btn-primary mb-2 mr-2">
                    {{ __('Search') }}
                  </button>
                  <a href="{{ route('searchIndex') }}" class="btn btn-primary mb-2">
                    {{ __('Reset') }}
                  </a>
                </div>
              </div>
            </form>
          </div>
        </div>

      {{-- Sida begynner her du --}}
      <div class="row text-left">
        @isset($trips)
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
        @endisset
      </div>

      {{-- Request::except('page') henter alle verdier fra addresslinja som ikke er page=1..2..3 osv --}}
      @isset($trips)
        <div class="paginator-container">
          {{ $trips->appends(Request::except('page'))->links() }}
        </div>
      @endisset


    </div>
  </div>
</div>
@endsection
