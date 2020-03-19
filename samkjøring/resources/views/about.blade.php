<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Samkjøring</title>

  <!-- Bootstrap core CSS -->
  <link href="{{URL::to('/')}}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="{{URL::to('/')}}/css/heroic-features.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Samkjøring AS</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="/test">Hjem</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/varslinger">Varslinger</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/login">Logg inn</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#top">Om oss
            <span class="sr-only">(current)</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">

    <!-- Jumbotron Header -->
    <header class="jumbotron my-4">
      <h1 class="display-3">Om Samkjøring AS!</h1>
      <p class="lead">Vi her i Samkjøring AS driter i corona viruset. Fyll alle biler opp så mye som mulig!</p>
      <p class="lead">Samkjøring AS starta i 1922 i et lite hjem i Rjukan, da Kjell Berit Kongshavn fikk sin første tandemsykkel. Inspirert av eksempelet satt av tandemsykkelen og
      samholdet i Rjukan Bedehus, starta Kjell Berit Samkjøring AS. Høsten 2022 fant Kjell Berit ut at hun/han ville starte på internett, så da ble de profesjonelle utviklerne
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



    <!-- Page Features
    <div class="row text-center">

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" src="http://placehold.it/500x325" alt="">
          <div class="card-body">
            <h4 class="card-title">Rute: Bø-Lærdal </h4>
            <p class="card-text"> 3 ledige plasser</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary">Bli med Joakim til Lærdal!</a>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" src="http://placehold.it/500x325" alt="">
          <div class="card-body">
            <h4 class="card-title">Rute: Bø-Paris</h4>
            <p class="card-text">2 ledige plasser</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary">Opplev Frankrike med Joachim!</a>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" src="{{URL::to('/')}}/img/ambulanse.jpg" alt="">
          <div class="card-body">
            <h4 class="card-title">Rute: Bø-Kasakhstan</h4>
            <p class="card-text">4 ledige plasser + 1 sykeseng (kjører med en veteran-ambulanse)</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary">Bli med Ross til Kasakhstan!</a>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" src="{{URL::to('/')}}/img/bøskien.jpg" alt="">
          <div class="card-body">
            <h4 class="card-title">Rute: Bø-Skien</h4>
            <p class="card-text">4 ledige plasser</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary">Bli med Sugal på skolen!</a>
          </div>
        </div>
      </div>

    </div> -->
    <!-- /.row -->

    <!-- Page Features 2

    <div class="row text-center">

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" src="http://placehold.it/500x325" alt="">
          <div class="card-body">
            <h4 class="card-title">Rute: Bø-Las Vegas </h4>
            <p class="card-text"> 2 ledige plasser</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary">Bli med Ahadd i bryllup!</a>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" src="http://placehold.it/500x325" alt="">
          <div class="card-body">
            <h4 class="card-title">Rute: Gvarv-Milano</h4>
            <p class="card-text">2 ledige plasser(skal forske på corona-viruset)</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary">Bli med Henrik å forsk!</a>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" src="http://placehold.it/500x325" alt="">
          <div class="card-body">
            <h4 class="card-title">Rute: Huset ditt-Ukjent</h4>
            <p class="card-text">1 ledig plass</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary">Bli med Kjell Berit på din beste (siste?) tur!</a>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" src="http://placehold.it/500x325" alt="">
          <div class="card-body">
            <h4 class="card-title">Rute: Stavanger - Rjukan </h4>
            <p class="card-text">4 ledige plasser</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary">Bli med på en spennende reise!</a>
          </div>
        </div>
      </div>

    </div> -->

    <!-- /.row -->



  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2020</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="{{URL::to('/')}}vendor/jquery/jquery.min.js"></script>
  <script src="{{URL::to('/')}}vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
