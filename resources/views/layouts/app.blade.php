<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Instituto Politécnico 30 de Setembro - Gestão de Processos</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- CSS Personalizado -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @yield('css')

    @livewireStyles
</head>

<body>
    {{ $slot }}

    <livewire:auth.login />

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    @yield('js')

    @livewireScripts
</body>

</html>
