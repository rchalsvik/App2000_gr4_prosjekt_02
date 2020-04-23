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
              <h3 class="overflow" style="width: 50%">
                <a class="" href="{{ route('seeMore', $trip->id) }}">
                  {{ $trip->start_point }} - <br>
                  {{ $trip->end_point }}
                </a>
              </h3>

                @if ($trip->trip_active)
                  <div class="ml-4 font-weight-bolder text-active flex-row"><span class="item">{{ __('Active') }}</span> <img class="text-icon" src="/img/icons/active.svg" alt="Active"></div>
                @else
                  <div class="ml-4 font-weight-bolder text-deactive flex-row"><span class="item">{{ __('Not active') }}</span> <img class="text-icon" src="/img/icons/deactive.svg" alt="Deactive"></div>
                @endif

            </div>

            <div class="mb-2">

                <div class="font-weight-bolder">
                  <img class="text-icon" src="/img/icons/active.svg" style="vertical-align: top" alt="Active">
                  <img class="text-icon" src="/img/icons/active.svg" style="vertical-align: top" alt="Active">
                  <div class="" style="display: inline-block;">
                    @samDateShortFormat($trip->start_date) @samYearFormat($trip->start_date)<br>
                    @samTimeFormat($trip->start_time)
                  </div>
                  <br><br>
                  <img class="text-icon" src="/img/icons/deactive.svg" alt="Active">@samDateShortFormat($trip->end_date) @samYearFormat($trip->end_date)<br>
                  @samTimeFormat($trip->end_time)
                </div>

            </div>
            <div class="ml-4" style="text-align: right">
              @if ($trip->trip_active)
                {{ $trip->seats_available }} {{ __('seats available') }}
              @else
                &nbsp;
              @endif

            </div>
          </div>
        </div>
      </div>
    @endforeach
    </div>
    </div>
  </div>
@endsection
