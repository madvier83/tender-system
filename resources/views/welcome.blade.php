<!DOCTYPE html>
<html data-theme="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tender System</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        * {
            padding: 0;
            margin: 0;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="">
    <div class="relative w-screen h-screen">
        <img src="img/bg.png" class="absolute top-0 left-0 w-full h-full object-cover blur-sm brightness-[.3]"
            alt="Background">
        <div class="relative z-10 flex flex-col justify-center items-center gap-16 w-full h-full">
            <div class="h-48 w-48 rounded-full overflow-hidden bg-white">
                <img src="img/logo.png" alt="logo">
            </div>
            <a href="/login" class="btn-lg text-2xl bg-white text-black font-bold px-16 py-4 rounded-full">Login</a>
            <a href="/tender-public" class="underline">Masuk sebagai vendor</a>
        </div>
    </div>
</body>

</html>
