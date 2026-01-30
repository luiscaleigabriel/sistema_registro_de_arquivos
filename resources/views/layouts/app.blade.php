<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Sistema de Aquivos</title>

        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

        @livewireStyles
    </head>
    <body>
        {{ $slot }}

        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}" ></script>

        @livewireScripts
    </body>
</html>
