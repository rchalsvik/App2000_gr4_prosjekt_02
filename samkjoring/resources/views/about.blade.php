@extends('layouts.app')

@section('content')

  <!-- Page Content -->
  <div class="container">

    <!-- Jumbotron Header -->
    <div class="page card my-4">
      <div class="">
        <img id="tandem" src="img/tandem.jpg" alt="tandemsykkel">
        <h1 class="display-3">{{ __('aboutTitle') }}</h1>
        <p class="lead">{{ __('aboutText') }}</p>
        <!-- <a href="/registration" class="btn btn-primary btn-lg">Registrer deg nå!</a> -->
      </div>

    </div>
    <div id="omossbilder">
  		<h1 id="vårebilder"></h1>
  		<figure>
  			<img id="tandem" src="img/tandem.jpg" alt="tandemsykkel">
  			<figcaption><b id="tandem">{{ __('Tandem-bike') }}</b></figcaption>
  		</figure>

  	</div>

@endsection
