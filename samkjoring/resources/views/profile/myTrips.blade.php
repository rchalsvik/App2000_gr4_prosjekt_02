@extends('layouts.app')

@section('content')
<!-- Page Content -->
<div class="container">

  <!-- Jumbotron Header -->
  <header class="jumbotron my-4">
    <h5 class="display-3">{{ __('My trips!') }}</h5>
  </header>

  <!-- Page Features -->
  <div class="row text-left">

    @foreach ($trips as $trip)

      {{--<!--
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
    -->--}}
      <div class="col-lg-6 col-md-6 mb-4">
        <div class="card mb-1 h-100">
          <div class="card-body">
            <div class="item-container item-c-100 item">
              <h3  class="">
                <a href="{{ route('seeMore', $trip->id) }}">{{ $trip->start_point }} - {{ $trip->end_point }}</a>
              </h3>

                @if ($trip->trip_active)
                <div class="ml-4 font-weight-bolder text-active">{{ __('Active') }} <img class="text-icon" src="/img/icons/active.svg" alt="Active"></div>
                @else
                <div class="ml-4 font-weight-bolder text-deactive">{{ __('Not Active') }} <img class="text-icon" src="/img/icons/deactive.svg" alt="Deactive"></div>
                @endif

            </div>

            <div class="">
              {{ __('Departure') }}:
            </div>
            <div class="font-weight-bolder">
              @samTimeFormat($trip->start_time) -
              @samDateFormat($trip->start_date)
              @samYearFormat($trip->start_date)
            </div>

            <div class="">
              {{ __('Arrival') }}:
            </div>
            <div class="font-weight-bolder">
              @samTimeFormat($trip->end_time) -
              @samDateFormat($trip->end_date)
              @samYearFormat($trip->end_date)
            </div>


            <div class="ml-4" style="text-align: right">
              {{ $trip->seats_available }} seats available
            </div>
          </div>
        </div>
      </div>
    @endforeach
    </div>
    </div>
  </div>
@endsection
