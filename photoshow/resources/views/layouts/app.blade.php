<html>
    <head>
        <meta charset="utf-8">
        <title>Photoshow</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        @include('inc.navbar')
        <br>
        @yield('content')
    </body>
</html>
