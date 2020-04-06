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

                    // Ikke vis begge dagene hvis de er like, Ross.
                    if ($testFrDateTime->isoFormat($testDateFormat) == $testToDateTime->isoFormat($testDateFormat))
                    {
                        echo '<strong>' . ucfirst($testToDateTime->isoFormat($testDateFormat)) . '</strong><br>';
                        echo __('Departure') . ': </td>' . $testFrDateTime->isoFormat($testTimeFormat) . '</strong><br>';
                        echo '🡫<br>';
                        echo __('Arrival')   . ': </td>' . $testToDateTime->isoFormat($testTimeFormat) . '</strong><br>';

                    } else {
                      //echo __('Departure') . ': ' . '<strong>' . $testFrDateTime->isoFormat($testDateTimeFormat) . '</strong><br>';
                      echo __('Departure') . ': ' . '<strong>' . $testFrDateTime->isoFormat($testTimeFormat) . '</strong><br>';
                      echo '<strong>' . $testFrDateTime->isoFormat($testDateFormat) . '</strong><br>';
                      echo '🡫<br>';
                      //echo __('Arrival')  . ': ' . '<strong>' . $testToDateTime->isoFormat($testDateTimeFormat) . '</strong><br>';
                      echo __('Arrival')  . ': ' . '<strong>' . $testToDateTime->isoFormat($testTimeFormat) . '</strong><br>';
                      echo '<strong>' . $testToDateTime->isoFormat($testDateFormat) . '</strong><br>';
                    }
                    echo '<br>';
                    // Carbon\CarbonInterface::DIFF_ABSOLUTE fjerner tilleggs tekst i diff
                    echo __('Traveltime') . ': ' . $testFrDateTime->diffForHumans($testToDateTime, Carbon\CarbonInterface::DIFF_ABSOLUTE) . '<br>';
                  ?>

                {{-- $trip->start_date . ' - ' . $trip->end_date . '<br>' --}}
                {{-- $trip->start_time . ' - ' . $trip->end_time --}}
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
