<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>@yield('titulo') | La Vendimia</title>

  <link rel="icon" href="{{ asset('favicon.ico') }}">

  {{-- Bootstrap --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
    crossorigin="anonymous">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
    crossorigin="anonymous">

  @yield('styles')
</head>

<body class="d-flex flex-column h-100">
  <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="/" aria-expanded="true">
            Inicio
          </a>
          <div class="dropdown-menu show">
            <a class="dropdown-item" href="{{ route('ventas.index') }}">Ventas</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Clientes</a>
            <a class="dropdown-item" href="#">Articulos</a>
            <a class="dropdown-item" href="#">Configuracion</a>
          </div>
        </li>
      </ul>
      <div class="text-white">
        Fecha: {{ date('d/m/Y') }}
      </div>
    </div>
  </nav>

  <main role="main" class="flex-shrink-0 pt-5">
    <div class="container mt-4" id="app">
      <div class="row">
        <div class="offset-md-1 col-md-11">
          @yield('main')
        </div>
      </div>
    </div>
  </main>

  <footer class="footer mt-auto py-3">
    <div class="container">
      <span class="text-muted">Sistema La Vendimia, 2020.</span>
    </div>
  </footer>

  {{-- Main Scripts --}}
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
    integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

  {{-- Extra Scripts --}}
  @yield('scripts')

</body>
</html>
