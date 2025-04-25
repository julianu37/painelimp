<nav x-data="{ open: false }" class="bg-gray-800 border-b border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-12 w-auto fill-current text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    {{-- Removido Home --}}
                    {{-- REMOVIDO: Códigos de Erro --}}
                    {{-- <x-nav-link :href="route('codigos.index')" :active="request()->routeIs('codigos.index') || request()->routeIs('codigos.show')" class="text-gray-300 hover:text-white focus:text-white">
                        {{ __('Códigos') }}
                    </x-nav-link> --}}
                    <x-nav-link :href="route('marcas.index')" :active="request()->routeIs('marcas.index') || request()->routeIs('marcas.show')" class="text-gray-300 hover:text-white focus:text-white">
                        {{ __('Marcas') }}
                    </x-nav-link>
                    <x-nav-link :href="route('modelos.index')" :active="request()->routeIs('modelos.index') || request()->routeIs('modelos.show')" class="text-gray-300 hover:text-white focus:text-white">
                        {{ __('Modelos') }}
                    </x-nav-link>
                    {{-- Removido Manuais --}}
                     {{-- TODO: Adicionar link para Vídeos se houver listagem pública --}}
                </div>
            </div>

            {{-- Formulário de Busca --}}
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <form method="GET" action="{{ route('busca.index') }}" class="flex items-center">
                    <input type="search" name="q" placeholder="Buscar..." required
                           value="{{ request('q') }}"
                           class="block w-full px-3 py-1.5 text-sm border rounded-md shadow-sm focus:outline-none bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                    <button type="submit" class="ml-2 p-2 text-gray-400 hover:text-gray-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </form>
            </div>

            <!-- Settings Dropdown or Login/Register Links -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                 @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-300 bg-gray-800 hover:text-white focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content" class="bg-gray-800">
                            {{-- Link para o Dashboard correto (Admin ou Técnico) --}}
                             @if (Auth::user()->isAdmin())
                                <x-dropdown-link :href="route('admin.dashboard')" class="text-gray-300 hover:bg-gray-700">
                                    {{ __('Painel Admin') }}
                                </x-dropdown-link>
                            @else
                                <x-dropdown-link :href="route('dashboard')" class="text-gray-300 hover:bg-gray-700">
                                    {{ __('Meu Painel') }} {{-- Ou Dashboard Técnico --}}
                                </x-dropdown-link>
                            @endif

                            <x-dropdown-link :href="route('profile.edit')" class="text-gray-300 hover:bg-gray-700">
                                {{ __('Meu Perfil') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();"
                                        class="text-gray-300 hover:bg-gray-700">
                                    {{ __('Sair') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                     {{-- Botão Login - Garantir texto branco no hover e manter ciano --}}
                    <a href="{{ route('login') }}"
                       class="inline-flex items-center px-4 py-2 bg-cyan-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-cyan-700 hover:text-white active:bg-cyan-800 focus:outline-none focus:border-cyan-900 focus:ring ring-cyan-300 disabled:opacity-25 transition ease-in-out duration-150">
                       {{ __('Log in') }}
                    </a>

                    @if (Route::has('register'))
                         {{-- Botão Registrar - Estilo Outline Ciano (mais claro) --}}
                         <a href="{{ route('register') }}"
                           class="ml-4 inline-flex items-center px-4 py-2 bg-transparent border border-cyan-400 rounded-md font-semibold text-xs text-cyan-400 uppercase tracking-widest shadow-sm hover:bg-cyan-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-cyan-600 focus:ring-offset-2 focus:ring-offset-gray-800 disabled:opacity-50 transition ease-in-out duration-150">
                            {{ __('Registrar') }}
                        </a>
                    @endif
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-300 hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-gray-300 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-gray-800">
        <div class="pt-2 pb-3 space-y-1">
             {{-- Removido Home --}}
             {{-- REMOVIDO: Códigos de Erro --}}
             {{-- <x-responsive-nav-link :href="route('codigos.index')" :active="request()->routeIs('codigos.index') || request()->routeIs('codigos.show')" class="text-gray-300 hover:text-white hover:bg-gray-700 focus:text-white focus:bg-gray-700">
                {{ __('Códigos') }}
            </x-responsive-nav-link> --}}
            <x-responsive-nav-link :href="route('marcas.index')" :active="request()->routeIs('marcas.index') || request()->routeIs('marcas.show')" class="text-gray-300 hover:text-white hover:bg-gray-700 focus:text-white focus:bg-gray-700">
                {{ __('Marcas') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('modelos.index')" :active="request()->routeIs('modelos.index') || request()->routeIs('modelos.show')" class="text-gray-300 hover:text-white hover:bg-gray-700 focus:text-white focus:bg-gray-700">
                {{ __('Modelos') }}
            </x-responsive-nav-link>
             {{-- Removido Manuais --}}
             {{-- TODO: Adicionar link responsivo para Vídeos --}}
        </div>

        {{-- Formulário de Busca Responsivo --}}
        <div class="pt-4 pb-3 border-t border-gray-700 px-4">
             <form method="GET" action="{{ route('busca.index') }}" class="flex items-center">
                <input type="search" name="q" placeholder="Buscar..." required
                        value="{{ request('q') }}"
                        class="block w-full px-3 py-1.5 text-sm border rounded-md shadow-sm focus:outline-none bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                <button type="submit" class="ml-2 p-2 text-gray-400 hover:text-gray-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </form>
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-700">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                     {{-- Link para o Dashboard correto --}}
                     @if (Auth::user()->isAdmin())
                        <x-responsive-nav-link :href="route('admin.dashboard')" class="text-gray-300 hover:text-white hover:bg-gray-700 focus:text-white focus:bg-gray-700">
                            {{ __('Painel Admin') }}
                        </x-responsive-nav-link>
                    @else
                        <x-responsive-nav-link :href="route('dashboard')" class="text-gray-300 hover:text-white hover:bg-gray-700 focus:text-white focus:bg-gray-700">
                             {{ __('Meu Painel') }}
                        </x-responsive-nav-link>
                    @endif

                    <x-responsive-nav-link :href="route('profile.edit')" class="text-gray-300 hover:text-white hover:bg-gray-700 focus:text-white focus:bg-gray-700">
                        {{ __('Meu Perfil') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();"
                                class="text-gray-300 hover:text-white hover:bg-gray-700 focus:text-white focus:bg-gray-700">
                            {{ __('Sair') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
             <div class="pt-4 pb-1 border-t border-gray-700">
                 <div class="mt-3 space-y-1">
                    {{-- Link/Botão Login Responsivo - Alinhado ao botão desktop (Ciano) --}}
                     <a href="{{ route('login') }}"
                        class="block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-white bg-cyan-600 hover:bg-cyan-700 hover:text-white focus:outline-none focus:bg-cyan-700 focus:border-cyan-800 transition duration-150 ease-in-out">
                         {{ __('Log in') }}
                    </a>
                    @if (Route::has('register'))
                         {{-- Link/Botão Registrar Responsivo - Estilo Outline Ciano (mais claro) --}}
                         <a href="{{ route('register') }}"
                            class="block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-cyan-400 hover:text-white hover:bg-cyan-500 hover:border-cyan-500 focus:outline-none focus:text-white focus:bg-cyan-500 focus:border-cyan-500 transition duration-150 ease-in-out">
                             {{ __('Registrar') }}
                        </a>
                    @endif
                 </div>
            </div>
        @endauth
    </div>
</nav>
