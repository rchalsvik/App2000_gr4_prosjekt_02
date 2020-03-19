@extends('layouts.app')

@section('content')
  <!-- Page Content -->
  <div class="container">

    <!-- Jumbotron Header -->
    <header class="jumbotron my-4">
      <h1 class="display-3">Velkommen til Samkjøring AS!</h1>
      <p class="lead"><h3>Finn på en enkel måte noen som skal samme vei som deg!</h3></p>
      <p><h3> Kjør smart, kjør billig, kjør bærekraftig, velg samkjøring AS!</h3></p>
      <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Registrer deg nå!</a>
    </header>

    <!-- Page Features -->
    <div class="row text-center">

      @foreach ($trips as $trip)
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card h-100">
            <img class="card-img-top" src="{{URL::to('/')}}/img/bølærdal.jpg" alt="">
            <div class="card-body">
              <h4 class="card-title">Rute: {{ $trip->start_point . ' - ' . $trip->end_point }} </h4>
              {{-- <h4 class="card-title">Rute: {{ $trip->start_point }} </h4> --}}
              <p class="card-text">
                {{ $trip->start_date . ' - ' . $trip->end_date }} <br />
                {{ $trip->start_time . ' - ' . $trip->end_time }}
             </p>
            </div>
            <div class="card-footer">
              <a href="#" class="btn btn-primary">Meld på tur</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
@endsection
