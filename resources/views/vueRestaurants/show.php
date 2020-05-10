<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>NetCamarero: Restaurantes</title>

    <!-- Scripts
    <script src="{{ asset('js/app.js') }}" defer></script>
    -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="../css/app.css" rel="stylesheet">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-danger" id="prinNav">
<a class="navbar-brand titulo" href="/"> <img src="../img/brand.png" class="netCB"> NetCamarero</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse navi" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/login">Entrar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/registrar">Registrar</a>
        </li>
      </ul>
    </div>
</nav>

    <div id="app">

        <div class="container-fluid contDetalles">
        <div class="row mainC">
            <div class="col-12 col-md-3">
            <img :src="'http://netcamareroapi.test/' + info.photo" class="imgrest">
            </div>
            <div class="col-12 col-md-9">
                <div class="row ml-2 mr-1">
                    <div class="col-12">
                        <h1 class="ttle">{{info.name}}</h1>
                    </div>
                    <div class="col-3">
                        <p class="detalle">Teléfono: {{info.phonenumber}}</p>
                    </div>
                    <div class="col-5">
                        <p class="detalle">Categoría: {{info.category.name}}</p>
                    </div>
                    <div class="col-4">
                        <p class="detalle">Localidad: {{info.city.name}}</p>
                    </div>
                    <div class="col-12">
                        <p class="detalle2">{{info.description}}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    </div>

<script src="https://unpkg.com/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="/js/scriptShow.js"></script>
</body>
</html>

<!--

 @if(auth()->user() != null)
                            @if($restaurante->esFavorito($restaurante->id))
                            <button class="btn btn-success rounded-pill"><a class="enlaceVer">Ya está en los favoritos!</a></button>
                            @else
                            <form action="{{ action('RestaurantController@addFav', ['restaurant' => $restaurante]) }}" method="POST">
                            {{method_field('PUT')}}
                            @csrf
                            <button class="btn btn-danger rounded-pill"><a class="enlaceVer">Añadir a favoritos</a></button>
                            </form>
                            @endif
                        @else
                        <button class="btn btn-danger rounded-pill"><a class="enlaceVer" href="{{ url('/login') }}">Entra en tu cuenta para añadir a Favoritos</a></button>
                        @endif

 -->
