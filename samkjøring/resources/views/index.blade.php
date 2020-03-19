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
          <li class="nav-item active">
            <a class="nav-link" href="#">Hjem
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/varslinger">Varslinger</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/login">Logg inn</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/omoss">Om oss</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

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

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" src="{{URL::to('/')}}/img/bølærdal.jpg" alt="">
          <div class="card-body">
            <h4 class="card-title">Rute: Bø-Lærdal </h4>
            <p class="card-text"> 17.Mars-2020</p>
            <p class="card-text"> 10:30-16:00</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary">Meld på tur</a>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" src="{{URL::to('/')}}/img/Borgund.jpg" alt="">
          <div class="card-body">
            <h4 class="card-title">Rute: Bø-Borgund</h4>
            <p class="card-text">12.Desember-2020</p>
            <p class="card-text">11:00-20-00</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary">Meld på tur</a>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" src="{{URL::to('/')}}/img/askertønsberg.jpg" alt="">
          <div class="card-body">
            <h4 class="card-title">Rute: Asker-Tønsberg</h4>
            <p class="card-text">3.April-2020</p>
            <p class="card-text">12:00-13:10</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary">Meld på tur</a>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" src="{{URL::to('/')}}/img/bøskien.jpg" alt="">
          <div class="card-body">
            <h4 class="card-title">Rute: Bø-Skien</h4>
            <p class="card-text">20.Mars-2020</p>
            <p class="card-text">08:00-09:04</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary">Meld på tur</a>
          </div>
        </div>
      </div>

    </div>
    <!-- /.row -->

    <!-- Page Features 2 -->

    <div class="row text-center">

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" src="{{URL::to('/')}}/img/bøski.jpg" alt="">
          <div class="card-body">
            <h4 class="card-title">Rute: Bø-Ski </h4>
            <p class="card-text"> 7.Mai-2020</p>
            <p class="card-text"> 10:00-12:45</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary">Meld på tur</a>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" src="{{URL::to('/')}}/img/trondheimtromsø.jpg" alt="">
          <div class="card-body">
            <h4 class="card-title">Rute: Trondheim-Tromsø</h4>
            <p class="card-text"> 6.Mai-2020</p>
            <p class="card-text"> 09:00-19:00</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary">Meld på tur</a>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" src="{{URL::to('/')}}/img/oslolillestrøm.jpg" alt="">
          <div class="card-body">
            <h4 class="card-title">Rute: Oslo-Lillestrøm</h4>
            <p class="card-text"> 7.Juli-2020</p>
            <p class="card-text"> 12:00-12:30</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary">Meld på tur</a>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" src="{{URL::to('/')}}/img/stavangerrjukan.jpg" alt="">
          <div class="card-body">
            <h4 class="card-title">Rute: Stavanger - Rjukan </h4>
            <p class="card-text">5.Mai-2020</p>
            <p class="card-text">12:00-18:00</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary">Meld på tur</a>
          </div>
        </div>
      </div>

    </div>

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
