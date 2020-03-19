@extends('layouts.app')

@section('content')

  <!-- Page Content -->
  <div class="container">

    <!-- Jumbotron Header -->
    <header class="jumbotron my-4">
      <h1 class="display-3">Om Samkjøring AS!</h1>
      <p class="lead">Samkjøring AS starta i 1922 i et lite hjem i Rjukan, da Kjell Berit Kongshavn fikk sin første tandemsykkel. Inspirert av eksempelet satt av tandemsykkelen og
      samholdet i Rjukan Bedehus, starta Kjell Berit Samkjøring AS. Høsten 2022 fant Kjell Berit ut at han ville starte på internett, så da ble de profesjonelle utviklerne
      "Gruppe4" satt på saken! </p>
      <!-- <a href="/registration" class="btn btn-primary btn-lg">Registrer deg nå!</a> -->
    </header>
    <div id="omossbilder">
  		<h1 id="vårebilder"></h1>
  		<figure>
  			<img id="tandem" src="img/tandem.jpg" alt="tandemsykkel">
  			<figcaption><b id="tandem">Tandem-sykkel</b></figcaption>
  		</figure>

  	</div>

@endsection
