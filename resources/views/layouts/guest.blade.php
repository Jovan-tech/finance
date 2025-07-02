<!-- guest-layout.blade.php -->
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
        <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            .font-lobster {
                font-family: 'Lobster', cursive;
            }
            .food-bg {
                background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
                background-size: cover;
                background-position: center;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased food-bg">
        <div class="min-h-screen flex items-center justify-center p-6">
            <div class="w-full max-w-md bg-white bg-opacity-95 rounded-2xl shadow-xl p-8 space-y-6">
                <!-- Logo Restoran -->
                <div class="text-center">
                    <h1 class="text-4xl font-bold text-red-600 font-lobster">Dadar Bobar</h1>
                    <p class="mt-2 text-gray-600">Selamat datang di dapur kami</p>
                </div>

                {{ $slot }}
            </div>
        </div>
    </body>
</html>