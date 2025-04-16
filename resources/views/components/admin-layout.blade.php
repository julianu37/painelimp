<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Admin</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        {{-- Wrapper principal com fundo claro e flex column para footer --}}
        <div class="min-h-screen bg-gray-100 flex flex-col">
            {{-- Inclui a navegação administrativa --}}
            @include('layouts.admin-navigation')

            <!-- Page Heading -->
            @if (isset($header))
                 {{-- Header Ciano Claro --}}
                <header class="bg-cyan-50 shadow border-b border-gray-200">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{-- Texto do Header Escuro --}}
                        <h2 class="font-semibold text-xl text-gray-700 leading-tight">
                             {{ $header }}
                        </h2>
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            {{-- Adicionado flex-grow para empurrar o footer --}}
            <main class="flex-grow">
                 {{-- Componente para exibir mensagens flash (adicionado por consistência) --}}
                 <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <x-alert-messages />
                 </div>
                {{-- Fim do container de mensagens --}}

                {{ $slot }}
            </main>

             {{-- Rodapé Escuro --}}
            <footer class="bg-gray-800 text-white text-center p-4">
                <div class="max-w-7xl mx-auto">
                    Feito com ❤️ por JM
                </div>
            </footer>
        </div>
    </body>
</html> 