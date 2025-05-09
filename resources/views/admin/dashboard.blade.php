<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Administrativo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Grade de Estatísticas --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                {{-- Card Técnicos --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg p-5 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        </div>
                        <div class="ml-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Técnicos</dt>
                            <dd class="text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $totalTecnicos }}</dd>
                        </div>
                    </div>
                     <div class="mt-4 text-sm">
                        <a href="{{ route('admin.tecnicos.index') }}" class="font-medium text-blue-600 dark:text-blue-400 hover:underline">Gerenciar Técnicos &rarr;</a>
                    </div>
                </div>

                 {{-- Card Marcas --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg p-5 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                             <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                        </div>
                        <div class="ml-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Marcas</dt>
                            <dd class="text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $totalMarcas }}</dd>
                        </div>
                    </div>
                    <div class="mt-4 text-sm">
                        <a href="{{ route('admin.marcas.index') }}" class="font-medium text-green-600 dark:text-green-400 hover:underline">Gerenciar Marcas &rarr;</a>
                    </div>
                </div>

                {{-- Card Modelos --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg p-5 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10em-1 .5-2 2.5c.5 1.5 1.5 2.5 3 3l-3.5 3.5a1 1 0 01-1.414 0l-3.5-3.5a1 1 0 010-1.414l3.5-3.5a1 1 0 011.414 0l3.5 3.5c1.5-1 2.5-2 3-3 .5-1 .5-2-1-3.5zM15 5a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        </div>
                        <div class="ml-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Modelos</dt>
                            <dd class="text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $totalModelos }}</dd>
                        </div>
                    </div>
                    <div class="mt-4 text-sm">
                        <a href="{{ route('admin.modelos.index') }}" class="font-medium text-yellow-600 dark:text-yellow-400 hover:underline">Gerenciar Modelos &rarr;</a>
                    </div>
                </div>

                {{-- Card Manuais --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg p-5 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-cyan-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                        </div>
                        <div class="ml-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Manuais</dt>
                            <dd class="text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $totalManuais }}</dd>
                        </div>
                    </div>
                    <div class="mt-4 text-sm">
                        <a href="{{ route('admin.manuais.index') }}" class="font-medium text-cyan-600 dark:text-cyan-400 hover:underline">Gerenciar Manuais &rarr;</a>
                    </div>
                </div>

                {{-- Card Adicionar Rápido Manual --}}
                 <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg p-5 border border-gray-200 dark:border-gray-700 flex flex-col justify-center items-center">
                    <a href="{{ route('admin.manuais.create') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 w-full text-center">
                       <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                       Novo Manual
                   </a>
               </div>
            </div>

            {{-- Seção de Itens Recentes --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Últimos Manuais Adicionados --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg border border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 px-6 py-4 border-b dark:border-gray-700">Últimos Manuais Adicionados</h3>
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($ultimosManuais as $manual)
                            <li class="px-6 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                <div class="flex justify-between items-center">
                                    <a href="{{ route('admin.manuais.edit', $manual) }}" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:underline truncate pr-4" title="{{ $manual->nome }}">
                                        {{ Str::limit($manual->nome, 60) }}
                                        {{-- Mostra o primeiro modelo associado, se houver --}}
                                        @if($manual->modelos->isNotEmpty())
                                            <span class="text-xs text-gray-500"> ({{ $manual->modelos->first()->nome }})</span>
                                        @endif
                                    </a>
                                    <span class="text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap">{{ $manual->created_at->diffForHumans(null, true) }}</span>
                                </div>
                            </li>
                        @empty
                            <li class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">Nenhum manual encontrado.</li>
                        @endforelse
                    </ul>
                    <div class="px-6 py-3 border-t dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50 text-right">
                        <a href="{{ route('admin.manuais.index') }}" class="text-xs font-medium text-indigo-600 dark:text-indigo-400 hover:underline">Ver Todos &rarr;</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>