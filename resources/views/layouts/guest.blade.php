<!DOCTYPE html>
<html data-theme="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tender System</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">

    
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-transparent">
        <img src="img/bg.png" class="absolute -z-50 top-0 left-0 w-full h-full object-cover blur-sm brightness-[.3]"
            alt="Background">

        <div>
            <a href="/">
                <div class="h-48 w-48 rounded-full overflow-hidden bg-white">
                    <img src="img/logo.png" alt="logo">
                </div>
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-8 py-8 bg-gray-800 text-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
