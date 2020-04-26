@extends('layouts.app')
@section('content')

<div class="container">

{{-- Forbanna Jumbotron --}}
<header class="jumbotron my-4">
@guest
  <header class="jumbotron my-4">
    <h1 class="">{{ __('Welcome to Haik!') }}</h1>
    <h3>{{ __('indexIntro') }}</h3>
    <h3>{{ __('indexPhrase') }}</h3>
    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">{{ __('Join us now!') }}</a>
  </header>
@endguest
@auth
  <h3>{{ __('Hello') }} {{ auth()->user()->firstname }}{{ __('!') }}</h3>
  {{--<h3>{{ __(heyheyGenerator(true)) }} {{ auth()->user()->firstname }}{{ __('!') }}</h3>--}}
  @if(auth()->user()->hasLicense)
    <a href="{{ route('createTrip') }}" class="btn btn-primary btn-lg">{{ __('Make a trip now!') }}</a>
    <a href="{{ route('myTrips') }}" class="btn btn-primary btn-lg">{{ __('My trips') }}</a>
    <a href="{{ route('myJoinedTrips') }}" class="btn btn-primary btn-lg">{{ __('Joined trips') }}</a>
  @endif
@endauth
</header>

{{--Hurtigsøkefelt--}}
<div class="mb-2">
  <form method="GET" action="{{ route('searchInIndex') }}" id="search_form" class="index-search-container">
    @csrf {{-- viktig! ellers så feiler siden --}}
    <div class="index-search-searchbar mr-2">
      <input id="idx_search" class="form-control index-item-height mb-1"
        type="text"
        class="clear @error('index_search') is-invalid @enderror"
        name="index_search"
        value="@if(isset($_GET['index_search'])){{ $_GET['index_search'] }}@else{{ $_SESSION['index_search'] = false }}@endif"
        placeholder="{{ __('Quick search') }}"
        autocomplete="start_point">
      <a href="/" class="index-reset-button">{{ __('Reset') }}</a>
    </div>

    <button type="search_the_index" class="btn btn-primary index-search-button index-item-height">
      {{ __('Search') }}
    </button>
  </form>
</div>

  {{-- Kjøttet --}}
  <div class="row text-center">

    @foreach ($trips as $trip)
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <a href="/trips/{{ $trip->id }}/seemore" class="">
            {{--<img class="card-img-top card-img-top-interactive" src="{{ URL::to('/') }}/img/bra_bil.jpg" alt="">--}}
            {{--<img class="card-img-top card-img-top-interactive" src="{{ URL::to('/') }}/{{ randomImagesThatWeTotallyOwnFromDirectoryOnMachine() }}" alt="Trip Images">--}}
            {{--<img class="card-img-top card-img-top-interactive" src="{{ URL::to('/') }}/{{ giMegBilde($trip->trip_image) }}" alt="Trip Images">--}}
            <img class="card-img-top card-img-top-interactive" src="{{ URL::to('/') }}{{ giMegBilde($trip->trip_image) }}" alt="{{ __('Trip Images') }}">
          </a>

          <div class="card-body">
            <h4 class="card-title">
              <a href="/trips/{{ $trip->id }}/seemore" class="card-title-link">
                {{ $trip->start_point . ' - ' . $trip->end_point }}
              </a>
            </h4>
            <div class="card-text">
              {{-- Ikke vis begge dagene hvis de er like, Ross. --}}
              @if ($trip->start_date == $trip->end_date)
                <b>@samFullDateFormat($trip->end_date)</b><br>
                {{ __('Leaving') }}: <b>@samTimeFormat($trip->start_time)</b><br>
                <img class="card-arrow-down" src="/img/icons/arrow_down.svg" alt="Arrow Down"><br>
                {{ __('Arriving') }}: <b>@samTimeFormat($trip->end_time)</b>
              @else
                {{ __('Leaving') }}: <b>@samTimeFormat($trip->start_time)</b><br>
                <b>@samDateFormat($trip->start_date)</b><br>
                <b>@samYearFormat($trip->start_date)</b><br>

                <img class="card-arrow-down" src="/img/icons/arrow_down.svg" alt="Arrow Down"><br>
                {{ __('Arriving') }}: <b>@samTimeFormat($trip->end_time)</b><br>
                <b>@samDateFormat($trip->end_date)</b><br>
                <b>@samYearFormat($trip->end_date)</b>
              @endif
            </div>

            {{-- Seter tilgjengelig --}}
            <div class="mt-4 card-seats-avail">
              {{ $trip->seats_available }} {{ __('seats available') }}
              <img class="ml-2 mb-n-1" src="/img/icons/chair_exotic.svg" alt="Seat">
            </div>

          </div>

          {{--<div class="card-seat-avail">
             <b>{{ $trip->seats_available }}x </b><img src="/img/icons/chair_line.svg" alt="Chair">
          </div>--}}

          <div class="card-footer">
            <a href="/trips/{{ $trip->id }}/seemore" class="btn btn-primary">{{ __('See more') }}</a>
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
@endsection
