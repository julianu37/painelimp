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
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            {{-- Inclui a navegação padrão do Breeze, mas podemos substituir por uma específica do admin --}}
            {{-- @include('layouts.navigation') --}}

            {{-- Layout Flexível: Sidebar + Conteúdo Principal --}}
            <div class="flex">
                {{-- Sidebar (Menu Lateral Fixo) --}}
                <aside class="w-64 bg-white dark:bg-gray-800 shadow h-screen sticky top-0 overflow-y-auto">
                    <div class="p-4">
                        {{-- Logo ou Nome do App --}}
                        <a href="{{ route('admin.dashboard') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                        </a>
                    </div>
                    <nav class="mt-5">
                        <ul>
                            <li class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <a href="{{ route('admin.dashboard') }}" class="block text-gray-700 dark:text-gray-200">Dashboard</a>
                            </li>
                            <li class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <a href="{{ route('admin.tecnicos.index') }}" class="block text-gray-700 dark:text-gray-200">Técnicos</a>
                            </li>
                            <li class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <a href="{{ route('admin.codigos.index') }}" class="block text-gray-700 dark:text-gray-200">Códigos de Erro</a>
                            </li>
                            <li class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <a href="{{ route('admin.solucoes.index') }}" class="block text-gray-700 dark:text-gray-200">Soluções</a>
                            </li>
                            <li class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <a href="{{ route('admin.manuais.index') }}" class="block text-gray-700 dark:text-gray-200">Manuais</a>
                            </li>
                            <li class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <a href="{{ route('admin.imagens.index') }}" class="block text-gray-700 dark:text-gray-200">Imagens</a>
                            </li>
                            <li class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <a href="{{ route('admin.videos.index') }}" class="block text-gray-700 dark:text-gray-200">Vídeos</a>
                            </li>
                            {{-- TODO: Adicionar link para gerenciamento de comentários, se houver uma página dedicada --}}
                            {{-- Logout --}}
                            <li class="px-4 py-2 mt-5 border-t border-gray-200 dark:border-gray-700">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); this.closest('form').submit();"
                                       class="block text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300">
                                        Sair
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </nav>
                </aside>

                {{-- Conteúdo Principal --}}
                <main class="flex-1">
                    {{-- Header (Opcional - pode ter o nome do usuário, etc) --}}
                     <header class="bg-white dark:bg-gray-800 shadow sticky top-0 z-10">
                        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                            <div>
                                @if (isset($header))
                                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                                        {{ $header }}
                                    </h2>
                                @endif
                            </div>
                            <div class="text-gray-500 dark:text-gray-400">
                                {{ Auth::user()->name }} (Admin)
                            </div>
                        </div>
                    </header>

                    {{-- Conteúdo da Página --}}
                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                             {{-- Componente para exibir mensagens flash --}}
                             <x-alert-messages />
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-gray-900 dark:text-gray-100">
                                    {{ $slot }}
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </body>
</html> 