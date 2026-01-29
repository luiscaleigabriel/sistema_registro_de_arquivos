<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mini Tweet</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    @livewireStyles
</head>
<body>

    <div class="container">
        {{ $slot }}
    </div>

    <link rel="stylesheet" href="{{ asset('assets/js/bootstrap.bundle.min.js') }}">

    @livewireScripts
</body>
</html>
