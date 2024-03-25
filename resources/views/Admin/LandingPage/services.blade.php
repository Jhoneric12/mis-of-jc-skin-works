<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>JC's Skin Works</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="{{asset('assets/Essentials/jcslogo.png')}}" type="image/x-icon">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="antialiased selection:bg-green-500 selection:text-[white] bg-[#F3F5F7]">

        @livewire('admin.landing-page.navbar')

        <main>
            @livewire('admin.landing-page.services')
        </main>

    </body>
</html>
