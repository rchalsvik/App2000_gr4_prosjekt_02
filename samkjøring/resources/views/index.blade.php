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

                  <?php
                    // Bruk Carbon for tid og dato.
                    // Ser ut som den respekterer locale(). Ross.
                    $testFrDateTime = new Carbon\Carbon($trip->start_date . $trip->start_time);
                    $testToDateTime = new Carbon\Carbon($trip->end_date . $trip->end_time);
                    $testDateFormat = 'dddd DD. MMMM';
                    $testTimeFormat = 'hh:mm';
                    $testDateTimeFormat = $testTimeFormat . ' - ' . $testDateFormat;

                    $test1 = 'Hest er best! ';
                    $test2 = 'Fest er ikke best.';
                  ?>

                  {{-- @samTest($test1, $test2)<br> --}}
                  {{-- @samTest2($trip->start_date, $trip->start_time)<br> --}}

                  {{-- Ikke vis begge dagene hvis de er like, Ross. --}}
                  @if ($testFrDateTime->isoFormat($testDateFormat) == $testToDateTime->isoFormat($testDateFormat))
                    <b>{{ ucfirst($testToDateTime->isoFormat($testDateFormat)) }}</b><br>
                    {{ __('Departure') }}: <b>{{ $testFrDateTime->isoFormat($testTimeFormat) }}</b><br>
                    🡫<br>
                    {{ __('Arrival') }}: <b>{{ $testToDateTime->isoFormat($testTimeFormat) }}</b><br>
                  @else
                    {{ __('Departure') }}: <b>{{ $testFrDateTime->isoFormat($testTimeFormat) }}</b><br>
                    <b>{{ $testFrDateTime->isoFormat($testDateFormat) }}</b><br>
                    🡫<br>
                    {{ __('Arrival') }}: <b>{{  $testToDateTime->isoFormat($testTimeFormat) }}</b><br>
                    <b>{{ $testToDateTime->isoFormat($testDateFormat) }}</b><br>
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
