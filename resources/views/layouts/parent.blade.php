<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', "JC's Skin Works")</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="shortcut icon" href="{{ asset('assets/Essentials/jcslogo.png') }}" type="image/x-icon">

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script> --}}

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased selection:bg-green-500 selection:text-[white] bg-[#F3F5F7]">

        <div>
            <x-Essentials.sidebar/>
        </div>

        {{-- Main Content  --}}

        <main>
            <div class="p-4 sm:ml-64">
                <div class="p-4  rounded-lg mt-14">
                    @yield('main-content')
                </div>
             </div>
        </main>

        @stack('modals')
        
        @stack('scripts')

        @stack('styles');

        @livewireScripts
    </body>
</html>
