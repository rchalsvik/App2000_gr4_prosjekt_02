@extends('layouts.app')

@section('content')
<div class="container">

  {{-- Jumbotron uch --}}
  <header class="jumbotron my-4">
    <h5 class="display-3">{{ __('My trips!') }}</h5>
  </header>

  {{-- Sida begynner her du --}}
  <div class="row text-left">
    @foreach ($trips as $trip)
      <div class="col-lg-6 col-md-6 mb-4">
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
              <div class="ml-4 font-weight-bolder flex     @if($trip->trip_active) text-active @else text-deactive @endif  ">
                @if ($trip->trip_active)
                  <div class="item">{{ __('Active') }}<img class="ml-2 mb-n-1" src="/img/icons/active.svg" alt="Active"></div>
                @else
                  <div class="item">{{ __('Not Active') }}<img class="ml-2 mb-n-1" src="/img/icons/deactive.svg" alt="Deactive"></div>
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
                {{ $trip->seats_available }} seats available
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
      {{ $trips->links() }}
    </div>

  </div>
@endsection
