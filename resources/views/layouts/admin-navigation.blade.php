<nav x-data="{ open: false }" class="bg-gray-800 border-b border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('admin.dashboard') }}">
                        {{-- Cor do "Logo" ajustada --}}
                        <span class="text-gray-200 font-semibold">Admin Panel</span>
                    </a>
                </div>

                <!-- Navigation Links (Usam x-nav-link já estilizado) -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.marcas.index')" :active="request()->routeIs('admin.marcas.*')">
                        {{ __('Marcas') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.modelos.index')" :active="request()->routeIs('admin.modelos.*')">
                        {{ __('Modelos') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.codigos.index')" :active="request()->routeIs('admin.codigos.*')">
                        {{ __('Códigos') }}
                    </x-nav-link>
                     {{-- Link Soluções Removido --}}
                     {{-- <x-nav-link :href="route('admin.solucoes.index')" :active="request()->routeIs('admin.solucoes.*')">
                        {{ __('Soluções') }}
                    </x-nav-link> --}}
                    <x-nav-link :href="route('admin.manuais.index')" :active="request()->routeIs('admin.manuais.*')">
                        {{ __('Manuais') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.tecnicos.index')" :active="request()->routeIs('admin.tecnicos.*')">
                        {{ __('Técnicos') }}
                    </x-nav-link>
                    {{-- Link para Importação --}}
                    <x-nav-link :href="route('admin.import.codigos.form')" :active="request()->routeIs('admin.import.codigos.form')">
                        {{ __('Importar Códigos') }}
                    </x-nav-link>
                     {{-- Links para Imagens/Vídeos podem ser adicionados se fizer sentido uma gestão centralizada --}}
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                         {{-- Cores do botão ajustadas --}}
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-300 bg-gray-800 hover:text-white focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                     {{-- Fundo e cores do dropdown ajustados --}}
                    <x-slot name="content" class="bg-gray-800">
                        <x-dropdown-link :href="route('profile.edit')" class="text-gray-300 hover:bg-gray-700">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                     class="text-gray-300 hover:bg-gray-700">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                {{-- Cores do hamburger ajustadas --}}
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
     {{-- Fundo e cores do menu responsivo ajustados --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-gray-800">
        <div class="pt-2 pb-3 space-y-1">
             {{-- Links responsivos usam x-responsive-nav-link já estilizado --}}
            <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
             <x-responsive-nav-link :href="route('admin.marcas.index')" :active="request()->routeIs('admin.marcas.*')">
                {{ __('Marcas') }}
            </x-responsive-nav-link>
             <x-responsive-nav-link :href="route('admin.modelos.index')" :active="request()->routeIs('admin.modelos.*')">
                {{ __('Modelos') }}
            </x-responsive-nav-link>
             <x-responsive-nav-link :href="route('admin.codigos.index')" :active="request()->routeIs('admin.codigos.*')">
                {{ __('Códigos') }}
            </x-responsive-nav-link>
            {{-- Link Responsivo Soluções Removido --}}
             {{-- <x-responsive-nav-link :href="route('admin.solucoes.index')" :active="request()->routeIs('admin.solucoes.*')">
                {{ __('Soluções') }}
            </x-responsive-nav-link> --}}
             <x-responsive-nav-link :href="route('admin.manuais.index')" :active="request()->routeIs('admin.manuais.*')">
                {{ __('Manuais') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.tecnicos.index')" :active="request()->routeIs('admin.tecnicos.*')">
                {{ __('Técnicos') }}
            </x-responsive-nav-link>
            {{-- Link Responsivo para Importação --}}
            <x-responsive-nav-link :href="route('admin.import.codigos.form')" :active="request()->routeIs('admin.import.codigos.form')">
                {{ __('Importar Códigos') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-700">
            <div class="px-4">
                 {{-- Cores do nome/email ajustadas --}}
                <div class="font-medium text-base text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                 {{-- Links responsivos já estilizados --}}
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav> 