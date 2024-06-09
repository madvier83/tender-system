<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Include Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="bg-black h-screen relative">
        <img src="{{ asset('img/bg.png') }}"
            class="fixed top-0 left-0 w-full h-full object-cover blur-sm brightness-[.3]" alt="Background">

        {{-- @include('layouts.navigation') --}}

        <!-- Page Heading -->
        {{-- @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif --}}

        <!-- Page Content -->
        <main class="z-50">
            {{ $slot }}
        </main>

        <script>
            $(document).ready(function() {
                // Store scroll position before form submission
                $('form').submit(function() {
                    sessionStorage.setItem('scrollPos', $(window).scrollTop());
                });
            
                // Restore scroll position after form submission
                var scrollPos = sessionStorage.getItem('scrollPos');
                if (scrollPos) {
                    $(window).scrollTop(scrollPos);
                    sessionStorage.removeItem('scrollPos');
                }
            });
            </script>
    </div>
</body>

</html>
