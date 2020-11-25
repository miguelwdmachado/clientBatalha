<!DOCTYPE html>
<html lang="pt-br">
<head>
@yield('head')
<!-- include('includes.pwa.pwa') -->
<title>Batalha Humano x Orc</title>
<meta charset="UTF-8">
<meta name="author" content="Miguel Walquirio Diniz Machado">
<meta name="description" content="Desafio proposto pela Oliveira Trust!">
<meta name="abstract" content="Desafio proposto pela Oliveira Trust!">
<meta name="keywords" content="deesafio, Oliveira Trust, miguel w d machado, miguel machado, miguelwdmachado">
<meta property="og:locale" content="pt-br">
<meta property="og:url" content="http://clientbatalha.com.br/">
<meta property="og:type" content="website">
<meta http-equiv="Content-Language" content="pt-br">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=yes" />
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="theme-color" content="#38D3FF">
<link rel="canonical" href="http://clientbatalha.com.br" />
<link rel="publisher" href="http://clientbatalha.com.br" />
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-grid.min.css">
<link rel="stylesheet" href="css/all.css">
<link rel="stylesheet" href="css/custom.css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,700,800,500" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Calligraffitti&display=swap" rel="stylesheet">

<style>

html, body {
    background-image: url("images/background.jpg");
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
    background-color: #fff;
    color: #636b6f;
    font-family: 'Calligraffitti', cursive;
    font-weight: 200;
    height: 100vh;
    margin: 0;
    z-index: 001;
    padding-top: 30px;
    overflow: hidden;
}

.full-height {
    height: 100vh;
}

.flex-center {
    align-items: center;
    display: flex;
    justify-content: center;
}

.position-ref {
    position: relative;
}

.top-right {
    position: absolute;
    right: 10px;
    top: 18px;
}

.content {
    text-align: center;
}

.title {
    font-size: 84px;
}

</style>

</head>

<body>
<!-- header e section da página home -->
@yield('header')
<!-- Header -->
<session>

<header>
  <nav class="navbar navbar-dark bg-info fixed-top">
      <a class="navbar-brand pb-2 fbold" href="http://clientbatalha.com.br">Home</a>
  </nav>
  <audio id="ajogo" src="/sounds/jogo.mp3" preload="auto"></audio>
  @if ($errors->any())
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
  @endif
  @if (Session::has('message'))
  <div class="alert alert-danger">
    <ul>{{ Session::get('message') }}</ul>
  </div>
  @endif
</header>

</session>

@yield('section1')
<!-- Modal -->
<div class="modal fade align-items-center justify-content-center" id="exampleModalCenter" tabindex="-1" role="mtela" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body text-center" id="mbody"><b></b></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-dismiss="modal">Continuar</button>
      </div>
    </div>
  </div>
</div>

@yield('footer')
<!-- Footer -->
<footer style="background-color: #606060">
</footer>
@yield('script')
<!-- Scripts -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
$(function() {
  $('#ajogo')[0].play();
});

</script>
</body>
</html>
