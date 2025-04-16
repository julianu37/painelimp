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

            {{-- Layout Flexível: Sidebar + Conteúdo Principal --}}
            {{-- Adicionado flex-grow para o conteúdo empurrar o footer --}}
            <div class="flex flex-grow">
                {{-- Sidebar (Menu Lateral Fixo) - Fundo Escuro --}}
                <aside class="w-64 bg-gray-800 shadow h-screen sticky top-0 overflow-y-auto">
                    <div class="p-4">
                        <!-- Logo - Cor ajustada -->
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('admin.dashboard') }}">
                                <x-application-logo class="block h-12 w-auto fill-current text-gray-200" />
                            </a>
                        </div>
                    </div>
                    <nav class="mt-5">
                        <ul>
                            {{-- Links com cores e hover ajustados E LÓGICA DE ATIVO --}}
                            <li class="px-4 py-2 hover:bg-gray-700 @if(request()->routeIs('admin.dashboard')) bg-gray-700 border-l-4 border-cyan-400 @endif">
                                <a href="{{ route('admin.dashboard') }}" class="block text-gray-300 hover:text-white">Dashboard</a>
                            </li>
                            <li class="px-4 py-2 hover:bg-gray-700 @if(request()->routeIs('admin.tecnicos.*')) bg-gray-700 border-l-4 border-cyan-400 @endif">
                                <a href="{{ route('admin.tecnicos.index') }}" class="block text-gray-300 hover:text-white">Técnicos</a>
                            </li>
                             <li class="px-4 py-2 hover:bg-gray-700 @if(request()->routeIs('admin.marcas.*')) bg-gray-700 border-l-4 border-cyan-400 @endif">
                                <a href="{{ route('admin.marcas.index') }}" class="block text-gray-300 hover:text-white">Marcas</a>
                            </li>
                             <li class="px-4 py-2 hover:bg-gray-700 @if(request()->routeIs('admin.modelos.*')) bg-gray-700 border-l-4 border-cyan-400 @endif">
                                <a href="{{ route('admin.modelos.index') }}" class="block text-gray-300 hover:text-white">Modelos</a>
                            </li>
                            <li class="px-4 py-2 hover:bg-gray-700 @if(request()->routeIs('admin.codigos.*')) bg-gray-700 border-l-4 border-cyan-400 @endif">
                                <a href="{{ route('admin.codigos.index') }}" class="block text-gray-300 hover:text-white">Códigos de Erro</a>
                            </li>
                            <li class="px-4 py-2 hover:bg-gray-700 @if(request()->routeIs('admin.solucoes.*')) bg-gray-700 border-l-4 border-cyan-400 @endif">
                                <a href="{{ route('admin.solucoes.index') }}" class="block text-gray-300 hover:text-white">Soluções</a>
                            </li>
                            <li class="px-4 py-2 hover:bg-gray-700 @if(request()->routeIs('admin.manuais.*')) bg-gray-700 border-l-4 border-cyan-400 @endif">
                                <a href="{{ route('admin.manuais.index') }}" class="block text-gray-300 hover:text-white">Manuais</a>
                            </li>
                            <li class="px-4 py-2 hover:bg-gray-700 @if(request()->routeIs('admin.imagens.*')) bg-gray-700 border-l-4 border-cyan-400 @endif">
                                <a href="{{ route('admin.imagens.index') }}" class="block text-gray-300 hover:text-white">Imagens</a>
                            </li>
                            <li class="px-4 py-2 hover:bg-gray-700 @if(request()->routeIs('admin.videos.*')) bg-gray-700 border-l-4 border-cyan-400 @endif">
                                <a href="{{ route('admin.videos.index') }}" class="block text-gray-300 hover:text-white">Vídeos</a>
                            </li>

                            {{-- Logout - Cor ajustada, hover com fundo --}}
                            <li class="px-4 py-2 mt-5 border-t border-gray-700 hover:bg-gray-700">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); this.closest('form').submit();"
                                       class="block text-red-400 hover:text-red-300">
                                        Sair
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </nav>
                </aside>

                {{-- Conteúdo Principal --}}
                <main class="flex-1">
                    {{-- Header - Fundo Ciano Claro, cores de texto ajustadas --}}
                     <header class="bg-cyan-50 shadow sticky top-0 z-10 border-b border-gray-200">
                        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                            <div>
                                @if (isset($header))
                                    <h2 class="font-semibold text-xl text-gray-700 leading-tight">
                                        {{ $header }}
                                    </h2>
                                @endif
                            </div>
                            <div class="text-gray-600">
                                {{ Auth::user()->name }} (Admin)
                            </div>
                        </div>
                    </header>

                    {{-- Conteúdo da Página - Fundo Branco --}}
                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                             <x-alert-messages />
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-gray-900">
                                    {{ $slot }}
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>

            {{-- Rodapé Escuro (removido mt-auto) --}}
            <footer class="bg-gray-800 text-white text-center p-4">
                <div class="max-w-7xl mx-auto">
                    Feito com ❤️ por JM
                </div>
            </footer>

        </div>
    </body>
</html> 