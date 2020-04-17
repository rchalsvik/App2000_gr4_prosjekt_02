@extends('layouts.app')

@section('content')
<!-- Page Content -->
<div class="container">

  <!-- Jumbotron Header -->
  <header class="jumbotron my-4">
    <h5 class="display-3">{{ __('My trips!') }}</h5>
  </header>

  <!-- Page Features -->
  <div class="row text-center">

    @foreach ($trips as $trip)
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-header">
            @if ($trip->trip_active)
              {{ __('Active') }}
            @else
              {{ __('Not active') }}
            @endif
          </div>
          <a href="/trips/{{ $trip->id }}/seemore" class="">
            <img class="card-img-top card-img-top-interactive" src="{{ URL::to('/') }}/{{ giMegBilde($trip->trip_image) }}" alt="Trip Images">
          </a>
          <div class="card-body">
            <a href="/trips/{{ $trip->id }}/seemore" class="card-title-link">
              <h4 class="card-title">{{ $trip->start_point . ' - ' . $trip->end_point }}</h4>
            </a>
            <p class="card-text">

                {{-- Ikke vis begge dagene hvis de er like, Ross. --}}
                @if ($trip->start_date == $trip->end_date)
                  <b>@samFullDateFormat($trip->end_date)</b><br>
                  {{ __('Departure') }}: <b>@samTimeFormat($trip->start_time)</b><br>
                  <img src="/img/icons/arrow_down.svg" alt="Arrow Down"><br>
                  {{ __('Arrival') }}: <b>@samTimeFormat($trip->end_time)</b><br>
                @else
                  {{ __('Departure') }}: <b>@samTimeFormat($trip->start_time)</b><br>
                  <b>@samDateFormat($trip->start_date)</b><br>
                  <b>@samYearFormat($trip->start_date)</b><br>

                  <img src="/img/icons/arrow_down.svg" alt="Arrow Down"><br>
                  {{ __('Arrival') }}: <b>@samTimeFormat($trip->end_time)</b><br>
                  <b>@samDateFormat($trip->end_date)</b><br>
                  <b>@samYearFormat($trip->start_date)</b><br>
                @endif
           </p>
          </div>
          <div class="card-footer">
            <a href="/trips/{{ $trip->id }}/seemore" class="btn btn-primary">{{ __('See more') }}</a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection
