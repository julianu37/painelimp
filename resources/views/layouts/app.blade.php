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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 flex flex-col">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-cyan-50 shadow border-b border-gray-200">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-grow">
                {{-- Container para exibir mensagens flash (sucesso, erro, etc.) --}}
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <x-alert-messages />
                </div>
                {{-- Fim do container de mensagens --}}

                {{ $slot }}
            </main>

            <footer class="bg-gray-800 text-white text-center p-4 mt-8">
                <div class="max-w-7xl mx-auto">
                    Feito com ❤️ por JM
                </div>
            </footer>
        </div>
    </body>
</html>
