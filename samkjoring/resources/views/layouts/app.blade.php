{{-- Laget og endret av Grp04 --}}

<!doctype html>
{{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> --}}
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  {{-- CSRF Token --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('name', 'Haik') }}</title>

  {{-- Scripts --}}
  <script src="{{ asset('js/app.js') }}" defer></script>

  {{-- Fonts --}}
  {{-- Bruker fonter fra Google --}}
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  {{--<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}
  {{--<link href="https://fonts.googleapis.com/css2?family=Scope+One&display=swap" rel="stylesheet">--}}
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">

  {{-- Styles --}}
  <link href="{{ asset('css/css') }}" rel="stylesheet">

  {{-- Bootstrap core CSS --}}
  <link href="{{URL::to('/')}}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  {{-- Custom styles for this template --}}
  {{-- Bruker ikke denne --}}
  {{-- <link href="{{URL::to('/')}}/css/heroic-features.css" rel="stylesheet"> --}}

  {{-- Samkjøring --}}
  {{-- Bruker samkjøring css for egen utforming --}}
  <link href="{{URL::to('/')}}/css/samkjøring.css" rel="stylesheet">

</head>
<body>
  <div id="app">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        {{-- Logo --}}
        <a class="navbar-brand" href="{{ route('index') }}">
          {{--HÆIK Avd. Lærdal AS--}}
          <img src="/img/haik_logo_01.svg" alt="hackaik logo">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse"
          data-target="#navbarResponsive" aria-controls="navbarResponsive"
          aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">

            {{-- INDEX --}}
            <li class="nav-item {{ Request::path() === '/' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('index') }}">
                {{ __('Home') }}
                <span class="sr-only">(current)</span>
              </a>
            </li>

            {{-- About Us --}}
            <li class="nav-item {{ Request::path() === 'omoss' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('about') }}">
                {{ __('About us') }}
              </a>
            </li>

            {{-- Drop Down Personlig Meny --}}
            {{-- Sjekker om login finnes i Route --}}
            @if (Route::has('login'))
              {{-- Sjekker om om klient er logget inn --}}
              @auth
                {{-- Melding på Navbar --}}
                <li class="nav-item dropdown align-items-start {{ Request::path() === 'home' ? 'active' : '' }}">
                  {{-- Sjekker om om logget inn bruker har uleste beskjeder (bool felt i user DBen) --}}

                    <a id="navbarDropdown" class="nav-link dropdown-toggle"
                      href="#" role="button" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false" v-pre>

                        {{-- Henter navn/etternavn av logget inn bruker --}}
                        {{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}

                        {{-- Sleng inn en "!" når bruker har melding --}}
                        @if (Auth::user()->hasUnreadMessages == 1) &#x2757;@endif
                        <span class="caret"></span>
                    </a>

                  {{-- Dæsjbård --}}
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                    {{-- Arbeidsmeny --}}
                    {{--Logga inn bruker har førerkort --}}
                    @if (auth()->user()->hasLicense)
                      {{-- Ny tur --}}
                      <a class="dropdown-item" href="{{ route('createTrip') }}">
                        {{ __('New trip') }}
                      </a>
                      {{-- Mine turer --}}
                      <a class="dropdown-item" href="{{ route('myTrips') }}">
                        {{ __('My trips') }}
                      </a>
                      {{-- Meldt på turer --}}
                      <a class="dropdown-item" href="{{ route('myJoinedTrips') }}">
                        {{ __('Joined trips') }}
                      </a>
                      <hr>
                    @endif

                    {{-- Person --}}
                    <a class="dropdown-item" href="{{ url('home') }}">
                      {{ __('Profile') }}
                    </a>

                    {{-- Notifications --}}
                    {{-- Sleng inn en "!" når bruker har melding --}}
                    <a class="dropdown-item" href="{{ route('notifications') }}">
                      {{ __('Notifications') }}
                      @if (Auth::user()->hasUnreadMessages == 1)
                         &#x2757;
                      @endif
                    </a>

                    {{-- LOGOUT --}}
                    <a class="dropdown-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}"
                      method="POST" style="display: none;">
                      @csrf {{-- viktig! ellers så feiler siden --}}
                    </form>
                  </div>
                </li>
              @else
                <li>
                  <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
              @endauth
            @endif

            {{-- Språk --}}
            {{-- Valg av språk --}}
            <li class="nav-item dropdown">
              <a id="navbarLangDropdown" class="nav-link dropdown-toggle" href="#"
                role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false" v-pre>
                  {{ __('Language') }} <span class="caret"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                {{-- Endre dette til enten "flagg ikon" eller "språk navn" --}}
                <a class="dropdown-item" href="{{ url('locale/no') }}">
                  <img class="lang-icon" src="/img/flags/norway.png" alt="No">
                  {{ __('Norsk')}}
                </a>
                <a class="dropdown-item" href="{{ url('locale/en') }}">
                  <img class="lang-icon" src="/img/flags/gb.png" alt="En">
                  {{ __('English')}}
                </a>
                <a class="dropdown-item" href="{{ url('locale/de') }}">
                  <img class="lang-icon" src="/img/flags/germany.png" alt="De">
                  {{ __('Deutsch')}}
                </a>
                <a class="dropdown-item" href="{{ url('locale/ru') }}">
                  <img class="lang-icon" src="/img/flags/russia.png" alt="Ru">
                  {{ __('Pусский')}}
                </a>
                <a class="dropdown-item" href="{{ url('locale/es') }}">
                  <img class="lang-icon" src="/img/flags/spain.png" alt="Es">
                  {{ __('Español')}}
                </a>
                <a class="dropdown-item" href="{{ url('locale/fr') }}">
                  <img class="lang-icon" src="/img/flags/france.png" alt="Es">
                  {{ __('Français')}}
                </a>
              </div>
            </li>

            {{-- Søk --}}
            <li class="nav-item {{ Request::path() === 'search' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('searchIndex') }}">
                {{ __('Search') }}
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <main class="py-4">
      @yield('content')
    </main>
  </div>

  {{-- Footer --}}
  <footer class="d-flex py-5 bg-dark mt-auto">
    <div class="container">
      <p class="m-0 text-center text-white">
        {{ __('Copyright') }} &copy; Grp04 2020
      </p>
    </div>
  </footer>

  {{-- Bootstrap core JavaScript --}}
  <script src="{{URL::to('/')}}vendor/jquery/jquery.min.js"></script>
  <script src="{{URL::to('/')}}vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
