  @extends('layouts.app')

@section('content')
  <!-- Page Content -->
  <div class="container">


    <!-- Jumbotron Header -->
    <header class="jumbotron my-4">
      @auth
      <h1 class="display-3">{{ __('Hello ' . Auth::user()->firstname) . '!' }}</h1>
      <p><h3>{{ __('indexLoginPhrase') }}</h3></p>
      @else
      <h1 class="display-3">{{ __('Welcome to Samkjoering AS!') }}</h1>
      <p class="lead"><h3>{{ __('indexIntro') }}</h3></p>
      <p><h3>{{ __('indexPhrase') }}</h3></p>
      <a href="{{ route('register') }}" class="btn btn-primary btn-lg">{{ __('Join us now!') }}</a>
      @endauth
    </header>


    <!-- Page Features -->
    <div class="row text-center">

      @foreach ($trips as $trip)
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card h-100">
            <img class="card-img-top" src="{{URL::to('/')}}/img/bølærdal.jpg" alt="">
            <div class="card-body">
              <h4 class="card-title">{{ $trip->start_point . ' - ' . $trip->end_point }}</h4>
              {{-- <h4 class="card-title">{{ __('Route') }}: {{ $trip->start_point . ' - ' . $trip->end_point }} </h4> --}}
              {{-- <h4 class="card-title">Rute: {{ $trip->start_point }} </h4> --}}
              <p class="card-text">

                  {{-- Ikke vis begge dagene hvis de er like, Ross. --}}
                  @if ($trip->start_date == $trip->end_date)
                    <b>@samDateFormat($trip->end_date)</b><br>
                    {{ __('Departure') }}: <b>@samTimeFormat($trip->start_time)</b><br>
                    {{-- &#x1F86B;<br> --}}
                    <img src="img/icons/arrowDown.png" alt="Arrow Down"><br>
                    {{ __('Arrival') }}: <b>@samTimeFormat($trip->end_time)</b><br>
                  @else
                    {{ __('Departure') }}: <b>@samTimeFormat($trip->start_time)</b><br>
                    <b>@samDateFormat($trip->start_date)</b><br>
                    <img src="img/icons/arrowDown.png" alt="Arrow Down"><br>
                    {{ __('Arrival') }}: <b>@samTimeFormat($trip->end_time)</b><br>
                    <b>@samDateFormat($trip->end_date)</b><br>
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
