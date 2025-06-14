<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="{{ asset('storage/logo/logo.png') }}"> <!-- imagen dentro de la pestaña


        <!-- Fuentes personalizadas -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&family=Roboto&display=swap" rel="stylesheet">

        <title>{{ config('app.name', 'Laravel') }}</title>


        <!-- Scripts -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/app.js') }}" defer></script>

    </head>
    <body class="font-cuerpo bg-white text-grisoscuro">
    <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        {{ $header ?? '' }}
    </div>
</header>


            <!-- Page Content -->
            <main>
    @yield('content')
</main>
        </div>
    </body>
</html>
