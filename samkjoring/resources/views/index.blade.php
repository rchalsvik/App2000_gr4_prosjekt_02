@extends('layouts.app')

@section('content')
<!-- Page Content -->
<div class="container">

  <!-- Jumbotron Header -->
  <header class="jumbotron my-4">
    <h1 class="display-3">{{ __('Welcome to Samkjoering AS!') }}</h1>
    <p class="lead"><h3>{{ __('indexIntro') }}</h3></p>
    <p><h3>{{ __('indexPhrase') }}</h3></p>
    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">{{ __('Join us now!') }}</a>
  </header>

  <div class="my-4">
    <div class="">
      <form method="GET" action="{{ route('searchInIndex') }}" id="search_form">
        @csrf {{-- viktig! ellers så feiler siden --}}
          <input id="index_searchbar" class="form-control index-searchbar"
            type="text"
            class="clear @error('index_search') is-invalid @enderror"
            name="index_search"
            value="@if(isset($_GET['index_search'])) {{ $_GET['index_search'] }}@else{{ $_SESSION['index_search'] = false }}@endif"
            placeholder="{{ __('Search') }}"
            autocomplete="start_point">

          <button type="search_the_index" class="btn btn-primary">
              {{ __('Search') }}
          </button>
      </form>
      {{--<button onclick="document.getElementById('index_search').value = ''">Clear input field</button>--}}

      <a id="reset1" href="/">{{ __('Reset') }}</a>
    </div>
  </div>


  <!-- Page Features -->
  <div class="row text-center">

    @foreach ($trips as $trip)
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <a href="/trips/{{ $trip->id }}/seemore" class="">


            {{--<img class="card-img-top card-img-top-interactive" src="{{URL::to('/')}}/img/bra_bil.jpg" alt="">--}}
            {{--<img class="card-img-top card-img-top-interactive" src="{{ URL::to('/') }}/{{ randomImagesThatWeTotallyOwnFromDirectoryOnMachine() }}" alt="Trip Images">--}}
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
                  <img class="card-arrow-down" src="/img/icons/arrow_down.svg" alt="Arrow Down"><br>
                  {{ __('Arrival') }}: <b>@samTimeFormat($trip->end_time)</b>
                @else
                  {{ __('Departure') }}: <b>@samTimeFormat($trip->start_time)</b><br>
                  <b>@samDateFormat($trip->start_date)</b><br>
                  <b>@samYearFormat($trip->start_date)</b><br>

                  <img class="card-arrow-down" src="/img/icons/arrow_down.svg" alt="Arrow Down"><br>
                  {{ __('Arrival') }}: <b>@samTimeFormat($trip->end_time)</b><br>
                  <b>@samDateFormat($trip->end_date)</b><br>
                  <b>@samYearFormat($trip->end_date)</b>
                @endif
           </p>
          </div>
          <div class="card-seat-avail">
             <b>{{ $trip->seats_available }}x </b><img src="/img/icons/chair_exotic.svg" alt="Chair">
          </div>
          <div class="card-footer">
            <a href="/trips/{{ $trip->id }}/seemore" class="btn btn-primary">{{ __('See more') }}</a>
          </div>
        </div>
      </div>
    @endforeach

    {{-- Request::except('page') henter alle verdier fra addresslinja som ikke er page=1..2..3 osv --}}
    <p>{{ $trips->appends(Request::except('page'))->links() }}</p>

  </div>
@endsection
