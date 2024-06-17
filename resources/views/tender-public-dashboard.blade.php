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
        <div class="relative z-10 flex flex-col justify-center items-center w-full h-full">
            <div class="h-48 w-48 rounded-full overflow-hidden bg-white">
                <img src="img/logo.png" alt="logo">
            </div>



            <div class="py-12">
                <div class="max-w-7xl mx-auto px-8 flex flex-col items-center justify-center h-full">
                    {{-- 
                    <div>
                        <a href="/">
                            <div class="h-48 w-48 rounded-full overflow-hidden bg-white mt-8">
                                <img src="img/logo.png" alt="logo">
                            </div>
                        </a>
                    </div> --}}

                    <div class="overflow-hidden shadow-sm rounded-lg text-center">
                        <div class="pb-6 text-white text-4xl">
                            Welcome
                        </div>
                    </div>

                    <div class="flex gap-4 mt-8">
                        <div>
                            <a href="/tender-public/list"
                                class="bg-gray-800 cursor-pointer p-10 text-white flex flex-col gap-4 items-center hover:bg-purple-800 h-full rounded-xl">
                                <div class="w-12">
                                    <img src="/img/suitcase.svg" alt="">
                                </div>
                                <h2 class="text-xl">Total Tender</h2>
                            </a>
                        </div>
                        <div>
                            <a href="/tender-public/list"
                                class="bg-gray-800 cursor-pointer p-10 text-white flex flex-col gap-4 items-center hover:bg-purple-800 h-full rounded-xl">
                                <div class="w-12">
                                    <img src="/img/diagram-up.svg" alt="">
                                </div>
                                <h2 class="text-xl">Tender Aktif</h2>
                            </a>
                        </div>
                        <div>
                            <a href="/tender-public/list"
                                class="bg-gray-800 cursor-pointer p-10 text-white flex flex-col gap-4 items-center hover:bg-purple-800 h-full rounded-xl">
                                <div class="w-12">
                                    <img src="/img/check.svg" alt="">
                                </div>
                                <h2 class="text-xl">Tender Selesai</h2>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>
