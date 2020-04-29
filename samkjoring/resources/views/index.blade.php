{{-- Endret av Grp04 --}}

@extends('layouts.app')
@section('content')
  <div class="container">

  {{-- Jumbotron --}}
  {{--Forskjellig JumboTr. til gjest og bruker --}}
  @auth
    <div class="sånnDerKontainer">
      <div class="sånnDerBy"></div>
      <div class="sånnDerBil"></div>
      <div class="sånnDerSted"></div>
    </div>
  @endauth
  <header class="jumbotron @guest my-4 @endguest">
  @guest
    <h1 class="">{{ __('Welcome to Haik!') }}</h1>
    <h3 class="display-3">{{ __('indexIntro') }}</h3>
    <h3 class="display-3">{{ __('indexPhrase') }}</h3>
    <a href="{{ route('register') }}" class="btn btn-primary btn-lg mt-4">{{ __('Join us now!') }}</a>
  @endguest
  @auth
    <h4 class="display-4">{{ __('Hello') }} {{ auth()->user()->firstname }}{{ __('!') }}</h3>
    @if(auth()->user()->hasLicense)
      <a href="{{ route('createTrip') }}" class="btn btn-primary btn-lg mt-4">{{ __('Make a trip now!') }}</a>
    @endif
  @endauth
  </header>


  {{--Hurtigsøkefelt--}}
  <div class="mb-4">
    <form method="GET" action="{{ route('searchInIndex') }}" id="search_form" class="index-search-container">
      @csrf {{-- viktig! ellers så feiler siden --}}
      <div class="index-search-searchbar mr-2">
        <input id="index_search" class="form-control index-item-height mb-1"
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

      {{-- Presenter Turene --}}
      @foreach ($trips as $trip)
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card h-100">
            <a href="/trips/{{ $trip->id }}/seemore">
              <img class="card-img-top card-img-top-interactive"
                src="{{ URL::to('/') }}{{ giMegBilde($trip->trip_image) }}"
                alt="{{ __('Trip Images') }}">
            </a>

            <div class="card-body d-flex flex-column">
              <h4 class="card-title">
                <a href="/trips/{{ $trip->id }}/seemore" class="card-title-link">
                  {{ $trip->start_point . ' - ' . $trip->end_point }}
                </a>
              </h4>
              <div class="card-text">
                {{-- Ikke vis begge dagene hvis de er like --}}
                {{-- For forklaring på dato- og tidsformatene under gå til app>ProvidersAppServiceProvider.php --}}
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
              <div class="card-seats-avail pt-4 mt-auto">
                {{ $trip->seats_available }} {{ __('seats available') }}
                <img class="ml-2 mb-n-1" src="/img/icons/chair_exotic.svg" alt="Seat">
              </div>
            </div>

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
