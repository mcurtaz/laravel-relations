<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Il link sarà al file css che sarà compilato (da npm run watch) a partire dal file sass/app.scss asset è un modo di laravel di linkare file del progetto nella cartella public (si usa per esempio anche nelle immagini)--}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> 
    <title>Laravel Relations</title>
</head>
<body>
    <div class="container">
        {{-- questo è il layout principale che useremo praticamente in tutte le pagine. Include prende l'html dal file che gli dici di includere e praticamente copia/incolla. yield fa l'opposto nel senso ci sarà un file con extend(layouts.main-layout) che prenderà tutto l'html di questa pagina compresi gli include e avrà una section('content') con dell'html che sarà messo al posto dello yield('content')--}}
        @include('partials.header')
        @yield('content')
        @include('partials.footer')
    </div>
</body>
</html>